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
use Cake\I18n\Number;
Number::setDefaultCurrency('INR');
/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products'],
        ];
        $packages = $this->paginate($this->Packages);

        $this->set(compact('packages'));
    }
    public function ajax(){
        $this->autoRender = false;
        $requestData= $this->request->getData();

        $columns = array(
            0 => 'Packages.id',
            1 => 'Products.name',
            2 => 'Packages.name',
            3 => 'Packages.no_of_days',
            4 => 'Packages.price',
            5 => 'Packages.discount_amt',
            6 => 'Packages.tax_amount',
            7 => 'Packages.net_amount',
            8 => 'Packages.is_monthly',
            9 => 'Packages.status'
        );
        $order = array('Packages.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('Packages')
                    ->find()
                    ->select($columns)->contain('Products');
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
            //$nestedData[] = $row->id;
            $nestedData[] = $row->product->name;
            if($row->is_monthly == 'No')
                $nestedData[] = $row->name.' <span class="kt-nav__link-badge"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">'.$row->is_monthly.'</span></span>';
            else 
                $nestedData[] = $row->name.' <span class="kt-nav__link-badge"><span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill kt-badge--rounded">'.$row->is_monthly.'</span></span>';
            $nestedData[] = Number::format($row->no_of_days);
            $nestedData[] = Number::currency($row->price);
            $nestedData[] = Number::currency($row->discount_amt);
            $nestedData[] = Number::currency($row->tax_amount);
            $nestedData[] = Number::currency($row->net_amount);
            if($row->status == 'Buy Now')
                $nestedData[] = '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Coming Soon')
                $nestedData[] = '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Enquiry')
                $nestedData[] = '<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Pending')
                $nestedData[] = '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            $nestedData[] = '<a title="Edit Package" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Packages', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a> | <a title="View Package" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Packages', 'action' => 'view', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
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
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => ['Products', 'Enquiries', 'PackageBenefits', 'PaymentLogs', 'Payments', 'ReleaseNotes', 'Subscriptions'],
        ]);

        $this->set(compact('package'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $package = $this->Packages->newEmptyEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $products = $this->Packages->Products->find('list', ['limit' => 200]);
        $this->set(compact('package', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $products = $this->Packages->Products->find('list', ['limit' => 200]);
        $this->set(compact('package', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function downloadExcel($type){
        ini_set('memory_limit', '-1');
        $packages = $this->getTableLocator()->get('Packages')
                    ->find()->contain('Products');
        $spreadsheet = new Spreadsheet();
        //Set document properties 
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('Packages')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('');
        // Add some data 
        $headerArray = ['Id', 'Product Name', 'Name','No of Day\'s','Price','Discount','Tax Amount','Net Amount','Is Monthly', 'Status'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('Packages');
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
        
        $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $i=2;
        foreach ( $packages->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $row->id);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->product->name);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $row->name);
            $spreadsheet->getActiveSheet()->getStyle('D'.$i.':H'.$i)->getNumberFormat();
            $spreadsheet->getActiveSheet()->setCellValue('D'.$i, Number::format($row->no_of_days));
            $spreadsheet->getActiveSheet()->setCellValue('E'.$i, Number::currency($row->price));
            $spreadsheet->getActiveSheet()->setCellValue('F'.$i, Number::currency($row->discount_amt));
            $spreadsheet->getActiveSheet()->setCellValue('G'.$i, Number::currency($row->tax_amount));
            $spreadsheet->getActiveSheet()->setCellValue('H'.$i, Number::currency($row->net_amount));
            $spreadsheet->getActiveSheet()->setCellValue('I'.$i, $row->is_monthly);
            $spreadsheet->getActiveSheet()->setCellValue('J'.$i, $row->status);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='Packages.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='Packages.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='Packages.pdf'; //save our workbook as this file name
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
