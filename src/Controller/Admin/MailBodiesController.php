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
 * MailBodies Controller
 *
 * @method \App\Model\Entity\MailBody[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MailBodiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $mailBodies = $this->paginate($this->MailBodies);

        $this->set(compact('mailBodies'));
    }

    public function ajax(){
        $this->autoRender = false;
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'MailBodies.id',
            1 => 'MailBodies.type',
            2 => 'MailBodies.subject'
        );
        $order = array('MailBodies.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('MailBodies')
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
            $nestedData[] = $row->type;
            $nestedData[] = $row->subject;
            $nestedData[] = '<a title="View Mail Template" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'MailBodies', 'action' => 'view', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a> | <a title="Edit Mail Body" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'MailBodies', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a>';
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
     * @param string|null $id Mail Body id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mailBody = $this->MailBodies->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('mailBody'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mailBody = $this->MailBodies->newEmptyEntity();
        if ($this->request->is('post')) {
            $mailBody = $this->MailBodies->patchEntity($mailBody, $this->request->getData());
            if ($this->MailBodies->save($mailBody)) {
                $this->Flash->success(__('The mail body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mail body could not be saved. Please, try again.'));
        }
        $this->set(compact('mailBody'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mail Body id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mailBody = $this->MailBodies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mailBody = $this->MailBodies->patchEntity($mailBody, $this->request->getData());
            if ($this->MailBodies->save($mailBody)) {
                $this->Flash->success(__('The mail body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mail body could not be saved. Please, try again.'));
        }
        $this->set(compact('mailBody'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mail Body id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mailBody = $this->MailBodies->get($id);
        if ($this->MailBodies->delete($mailBody)) {
            $this->Flash->success(__('The mail body has been deleted.'));
        } else {
            $this->Flash->error(__('The mail body could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
