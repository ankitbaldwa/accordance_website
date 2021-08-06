<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Routing\Router;
/** Import phpspreadsheet libary */
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }
    public function ajax(){
        $this->autoRender = false;
        $requestData= $this->request->getData();

        $columns = array(
            0 => 'Products.id',
            1 => 'Products.name',
            2 => 'Products.image',
            3 => 'Products.status'
        );
        $order = array('Products.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('Products')
                    ->find()
                    ->select($columns)
                    ->contain(['ProductFeatures']);
        /** For where condition  */
        $i = 0;
        $condition = [];
        $cond = [];
        foreach ($columns as $item) // loop column 
        {
            if ($requestData['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    //$cond = [$item.' LIKE' => '%'.$requestData['search']['value'].'%'];
                } else {
                    $cond += [$item.' LIKE' => '%'.$requestData['search']['value'].'%'];
                }
            }
            $i++;
        }
        if(!empty($cond))
            $condition = ['OR' => $cond];   
        $query->where($condition);
        /** For order by */
        if (isset($requestData['order'])) // here order processing
        {
            $query->order([$columns[$requestData['order'][0]['column']] => $requestData['order'][0]['dir']]);
        } else if (isset($order)) {
            $query->order([key($order) => $order[key($order)]]);
        }
        /** For Pageination */
        if ( ( $page  > 0 ) && ( $offset) ) {
            $query->limit($offset)->page(($page/$offset)+1);
        } else {
            $query->limit($offset);
        }
        /** For count no of records */
    	$results = $query->count();
    	$totalData = isset($results) ? $results : 0;

        $totalFiltered = $totalData;

        //pr($query->all());exit;
        //$SQL = $detail." ORDER BY $sidx $sord LIMIT $start , $length ";
    	//$results = $conn->execute( $SQL )->fetchAll('assoc');

    	$i = 0;
        $data = array();
    	foreach ( $query->all() as $row){
            $nestedData= [];
            $nestedData[] = $row->id;
            $nestedData[] = $row->name;
            if(!empty($row->image))
                $nestedData[] = "<img src='../img/products/". $row->image."' alt='Image' width='30%'>";
            else 
                $nestedData[] = "N/A";
            $nestedData[] = '<a title="View Product Features" href="'.Router::url(['prefix'=>'Admin','controller' => 'ProductFeatures', 'action' => 'index', enc_dec(1, (String) $row->id)]).'"><span class="kt-badge kt-badge--dark kt-badge--lg">'.count($row->product_features).'</span></a>';
            if($row->status == 1)
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Products', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span></a>';
            else if($row->status == 0)
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Products', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Inactive</span></a>';
            else 
                $nestedData[] = '<span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">Default</span>';
            $nestedData[] = '<a title="Edit Product" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Products', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a> | <a title="View Product" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Products', 'action' => 'view', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
            $data[] = $nestedData;
    		$i++;
    	}
        $json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
        );
        echo json_encode($json_data);exit;
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Packages', 'ProductFeatures'],
        ]);

        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if(!empty($product->image)){
                $image = $this->request->getData('image');
                $name = date('Ymdhis').'_'.$image->getClientFilename();
                $targetPath = WWW_ROOT .  'img' . DS . 'products'. DS . $name;
                if($name){ 
                    $image->moveTo($targetPath);
                    $product->image = $name;
                }
            }
            $product->slug = $this->request->getData()['slug'];
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'Product has been saved successfully!')); exit;
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The product could not be saved. Please, try again.')); exit;
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if(!empty($product->image)){
                $image = $this->request->getData('image');
                $name = date('Ymdhis').'_'.$image->getClientFilename();
                $targetPath = WWW_ROOT .  'img' . DS . 'products'. DS . $name;
                if($name){ 
                    $image->moveTo($targetPath);
                    $product->image = $name;
                }
            } else {
                unset($product->image);
            }
            $product->slug = $this->request->getData()['slug'];
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'Product has been updated successfully!')); exit;
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The product could not be saved. Please, try again.')); exit;
        }
        $this->set(compact('product'));
    }
    /**
     * Change status method
     * @param string|null $id Products id.
     */
    public function status($id = null){
        if ($this->request->is(['post'])) {
            $ProductsTable = $this->getTableLocator()->get('Products');
            $Products = $ProductsTable->get($id); // Return Products with id

            $Products->status = $this->request->getData()['status'];
            if($Products->status == 'Active')
                $Products->status = 1;
            else 
                $Products->status = 0;
            $ProductsTable->save($Products);
            echo 1;exit;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function downloadExcel($type){
        ini_set('memory_limit', '-1');
        $cities = $this->getTableLocator()->get('Products')
                    ->find();
        $spreadsheet = new Spreadsheet();
        //Set document properties 
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('Products')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('Location');
        // Add some data 
        $headerArray = ['Id', 'Name', 'Status'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('Products');
        $spreadsheet->getActiveSheet()->setAutoFilter(
            $spreadsheet->getActiveSheet()
                ->calculateWorksheetDimension()
        );
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $i=2;
        foreach ( $cities->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $row->id);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->name);
            if($row->status == 0)
                $status = 'Inactive';
            else if($row->status == 1)
                $status = 'Active';
            else 
                $status = 'Default';
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $status);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='Products.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='Products.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='Products.pdf'; //save our workbook as this file name
            $writer = new Mpdf($spreadsheet);
            $writer->setPreCalculateFormulas(false);
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            header("Cache-control: private"); //use this to open files directly 
            $writer->save('php://output'); // download file
        }
        die;
    }
}
