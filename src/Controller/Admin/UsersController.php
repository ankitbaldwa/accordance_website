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

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }
    public function login()
    {
        if ($this->request->is('post')) {
            $this->request->allowMethod(['get', 'post']);
            $result = $this->Authentication->getResult();
            // regardless of POST or GET, redirect if user is logged in
            if ($result->isValid()) {
                if(empty($this->request->getQuery('redirect'))){
                    $target = $this->loginRedirectByRole();
                    //$redirect = $this->request->getQuery('redirect', $target);
                    //echo JSON_encode(array('status'=>0, 'url'=>$target));exit;
                    return $this->redirect($target);
                } else {
                    return $this->redirect($this->request->getQuery('redirect'));
                }
            }
            // display error if user submitted and authentication failed
            if ($this->request->is('post') && !$result->isValid()) {
                $this->Flash->error(__('Invalid username or password'));
                //echo JSON_encode(array('status'=>1, 'Message'=>'Invalid username or password'));exit;
            }
        }
    }
    public function loginRedirectByRole() {
        $identity = $this->getRequest()->getAttribute('identity');
        switch ($identity->get('role')) {
            case 'Admin':
                $url = ['prefix'=>'Admin','controller' => 'Users', 'action' => 'dashboard'];
                break;
            case 'User':
                $url = ['prefix'=>'Admin','controller' => 'Users', 'action' => 'index'];
                break;
            default:
                $url = ['unknown role url'];
                break;
        }
        return $url;
        //return Router::url($url);
    }
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
    public function dashboard(){

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function ajax($id=""){
        $this->autoRender = false;
        if(!empty($id))
            $id = enc_dec(2, $id);
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'Users.id',
            1 => 'Users.name',
            2 => 'Users.email',
            3 => 'Users.role',
            4 => 'Users.mobile',
            5 => 'Users.status'
        );
        $order = array('Users.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('Users')
                    ->find()
                    ->select($columns);
        /** For where condition  */
        $i = 0;
        $condition = ['Users.role !='=>'Admin'];
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
            $nestedData[] = $row->id;
            $nestedData[] = $row->name;
            $nestedData[] = $row->email;
            $nestedData[] = $row->role;
            $nestedData[] = $row->mobile;
            $nestedData[] = $row->status;
            $nestedData[] = '<a title="View User" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Users', 'action' => 'view', enc_dec(1, (String) $row->id)]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(!empty($id))
            $id = enc_dec(2, $id);
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function downloadExcel($type){
        ini_set('memory_limit', '-1');
        $columns = array(
            0 => 'Users.id',
            1 => 'Users.name',
            2 => 'Users.email',
            3 => 'Users.role',
            4 => 'Users.mobile',
            5 => 'Users.status'
        );
        $Users = $this->getTableLocator()->get('Users')
                    ->find()->select($columns)->where();
        $spreadsheet = new Spreadsheet();
        //Set document properties
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('Users')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('Users');
        // Add some data
        $headerArray = ['Id', 'Name', 'Email','Role','Mobile','Status'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('Users');
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

        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $i=2;$counter=0;
        foreach ( $Enquiries->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, ++$counter);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->name);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $row->email);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$i, $row->role);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$i, $row->mobile);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$i, $row->status);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='Users.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='Users.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='Users.pdf'; //save our workbook as this file name
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
    public function excel(){
        $spreadsheet = new Spreadsheet();
        $helper = new Helper\Sample();
        $helper->log( 'Create new Spreadsheet object' );
        $spreadsheet  = new Spreadsheet();
        //Set document properties
        $helper->log('Set document properties');
        $spreadsheet ->getProperties()
        ->setCreator('shubh ')
        ->setLastModifiedBy('Arjun')
        ->setTitle('Example')
        ->setSubject('Example')
        ->setDescription('Example')
        ->setKeywords('office PhpSpreadsheet php')
        ->setCategory('Example');
        // Add some data
        $helper ->log('Add some data');
        $spreadsheet ->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Hello')
        ->setCellValue('B2', 'world!')
        ->setCellValue('C1', 'Hello')
        ->setCellValue('D2', 'world!');
        $helper ->log('Rename worksheet');
        $spreadsheet ->getActiveSheet()
        ->setTitle('Simple');
        $filename='Report_For_Month.xlsx'; //save our workbook as this file name

        ob_end_clean();
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename);
        header('Cache-Control: max-age=0');
        $writer->setPreCalculateFormulas(true);
        //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
        $writer->save('php://output'); // download file
        die;
    }
    public function importExcelfiles(){
        $helper = new Helper\Sample();
        debug($helper);
        $inputFileName = WWW_ROOT . 'example1.xlsx';
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        var_dump($sheetData);
        die('here');
    }
}
