<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Routing\Router;
/** Import phpspreadsheet libary */
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
