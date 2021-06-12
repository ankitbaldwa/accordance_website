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
 * ProductFeatures Controller
 *
 * @property \App\Model\Table\ProductFeaturesTable $ProductFeatures
 * @method \App\Model\Entity\ProductFeature[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductFeaturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id = "")
    {
        $id = enc_dec(2, $id);
        $this->paginate = [
            'contain' => ['Products'],
        ];
        $this->loadModel('Products');
        $product = $this->Products->get($id);

        $productFeatures = $this->paginate($this->ProductFeatures);

        $this->set(compact('productFeatures', 'product'));
    }
    public function ajax($id = null){
        $this->autoRender = false;
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'ProductFeatures.id',
            1 => 'ProductFeatures.name',
            2 => 'ProductFeatures.status',
        );
        $order = array('ProductFeatures.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('ProductFeatures')
                    ->find()
                    ->select($columns);
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
            $condition = ['ProductFeatures.product_id' => $id, 'OR' => $cond];
        else 
            $condition = ['ProductFeatures.product_id' => $id];
        
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
            $nestedData= [];$i++;
            $nestedData[] = $i;
            //$nestedData[] = $row->product->name;
            $nestedData[] = $row->name;
            if($row->status == 1)
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'ProductFeatures', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span></a>';
            else
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'ProductFeatures', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Inactive</span></a>';
            $nestedData[] = '<a title="Edit Product" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'ProductFeatures', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a> | <a title="View Product" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'ProductFeatures', 'action' => 'view', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
            $data[] = $nestedData;
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
     * @param string|null $id Product Feature id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productFeature = $this->ProductFeatures->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set(compact('productFeature'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productFeature = $this->ProductFeatures->newEmptyEntity();
        if ($this->request->is('post')) {
            $productFeature = $this->ProductFeatures->patchEntity($productFeature, $this->request->getData());
            if ($this->ProductFeatures->save($productFeature)) {
                $this->Flash->success(__('The product feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product feature could not be saved. Please, try again.'));
        }
        $products = $this->ProductFeatures->Products->find('list', ['limit' => 200]);
        $this->set(compact('productFeature', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Feature id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productFeature = $this->ProductFeatures->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productFeature = $this->ProductFeatures->patchEntity($productFeature, $this->request->getData());
            if ($this->ProductFeatures->save($productFeature)) {
                $this->Flash->success(__('The product feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product feature could not be saved. Please, try again.'));
        }
        $products = $this->ProductFeatures->Products->find('list', ['limit' => 200]);
        $this->set(compact('productFeature', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Feature id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productFeature = $this->ProductFeatures->get($id);
        if ($this->ProductFeatures->delete($productFeature)) {
            $this->Flash->success(__('The product feature has been deleted.'));
        } else {
            $this->Flash->error(__('The product feature could not be deleted. Please, try again.'));
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
