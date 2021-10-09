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
use Cake\I18n\Time;
Number::setDefaultCurrency('INR');

/**
 * Payments Controller
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $payments = $this->paginate($this->Payments);

        $this->set(compact('payments'));
    }
    public function ajax($id=""){
        $this->autoRender = false;
        $id = enc_dec(2, $id);
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'Payments.id',
            1 => 'Payments.company',
            2 => 'Users.name',
            3 => 'Packages.name',
            4 => 'Payments.amount',
            5 => 'Payments.discount_amt',
            6 => 'Payments.tax_amount',
            7 => 'Payments.net_amount',
            8 => 'Payments.payment_date',
            9 => 'Payments.package_start_date',
            10 => 'Payments.package_end_date',
            11 => 'Payments.status'
        );
        $order = array('Payments.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('Payments')
                    ->find()
                    ->contain(['Users','Packages'])
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
            $i++;
            $nestedData[] = $row->user->name;
            $nestedData[] = $row->company;
            $nestedData[] = $row->package->name;
            $nestedData[] = Number::currency($row->amount);
            $nestedData[] = Number::currency($row->discount_amt);
            $nestedData[] = Number::currency($row->tax_amount);
            $nestedData[] = Number::currency($row->net_amount);
            $nestedData[] = date('d-m-Y',strtotime(h($row->payment_date)));
            $nestedData[] = date('d-m-Y', strtotime(h($row->package_start_date)));
            $nestedData[] = date('d-m-Y', strtotime(h($row->package_end_date)));
            if($row->status == 'Completed')
                $nestedData[] = '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Pending')
                $nestedData[] = '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            $nestedData[] = '<a title="View Payments" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Payments', 'action' => 'view', enc_dec(1, (String) $row->id)]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
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
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = enc_dec(2, $id);
        $payment = $this->Payments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('payment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $this->set(compact('payment'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $this->set(compact('payment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function downloadExcel($type){
        ini_set('memory_limit', '-1');
        $columns = array(
            0 => 'Payments.id',
            1 => 'Payments.company',
            2 => 'Users.name',
            3 => 'Packages.name',
            4 => 'Payments.amount',
            5 => 'Payments.discount_amt',
            6 => 'Payments.tax_amount',
            7 => 'Payments.net_amount',
            8 => 'Payments.payment_date',
            9 => 'Payments.package_start_date',
            10 => 'Payments.package_end_date',
            11 => 'Payments.status'
        );
        $Payments = $this->getTableLocator()->get('Payments')
                    ->find()->contain(['Packages','Users'])->select($columns)->where();
        $spreadsheet = new Spreadsheet();
        //Set document properties
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('Payments')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('Payments');
        // Add some data
        $headerArray = ['Id', 'Package', 'Company','User Name','Amount','Discount Amount','Tax Amount', 'Net Amount', 'Payment Date', 'Package Start Date', 'Package End Date','Status'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('Payment');
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

        $spreadsheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $i=2;$counter=0;
        foreach ( $Payments->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, ++$counter);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->package->name);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $row->company);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$i, $row->user->name);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$i, Number::currency($row->amount));
            $spreadsheet->getActiveSheet()->setCellValue('F'.$i, Number::currency($row->discount_amt));
            $spreadsheet->getActiveSheet()->setCellValue('G'.$i, Number::currency($row->tax_amount));
            $spreadsheet->getActiveSheet()->setCellValue('H'.$i, Number::currency($row->net_amount));
            $spreadsheet->getActiveSheet()->setCellValue('I'.$i, date('d-m-Y',strtotime(h($row->payment_date))));
            $spreadsheet->getActiveSheet()->setCellValue('J'.$i, date('d-m-Y', strtotime(h($row->package_start_date))));
            $spreadsheet->getActiveSheet()->setCellValue('K'.$i, date('d-m-Y', strtotime(h($row->package_end_date))));
            $spreadsheet->getActiveSheet()->setCellValue('L'.$i, $row->status);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='Payments.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='Payments.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='Payments.pdf'; //save our workbook as this file name
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
