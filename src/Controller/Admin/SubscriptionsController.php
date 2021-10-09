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
 * Subscriptions Controller
 *
 * @method \App\Model\Entity\Subscription[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubscriptionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $subscriptions = $this->paginate($this->Subscriptions);

        $this->set(compact('subscriptions'));
    }

    public function ajax($id=""){
        $this->autoRender = false;
        if(!empty($id))
            $id = enc_dec(2, $id);
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'Payments.order_id',
            1 => 'Users.name',
            2 => 'Packages.name',
            3 => 'Subscriptions.company_name',
            4 => 'Subscriptions.company_code',
            5 => 'Subscriptions.company_url',
            6 => 'Subscriptions.company_db_host',
            7 => 'Subscriptions.company_db_username',
            8 => 'Subscriptions.company_db_password',
            9 => 'Subscriptions.company_db_database',
            10 => 'Subscriptions.amount',
            11 => 'Subscriptions.start_date',
            12 => 'Subscriptions.end_date',
            13 => 'Subscriptions.status',
            14 => 'Subscriptions.id'
        );
        $order = array('Subscriptions.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('Subscriptions')
                    ->find()
                    ->contain(['Users','Packages','Payments'])
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
            $nestedData[] = $row->payment->order_id;
            $nestedData[] = $row->user->name;
            $nestedData[] = $row->package->name;
            $nestedData[] = $row->company_name;
            $nestedData[] = $row->company_code;
            $nestedData[] = '<a title="'.$row->company_url.'" target="_blank" onclick="browserWindow(event);" href="'.$row->company_url.'" class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill kt-badge--rounded">View Url</a>';
            $nestedData[] = $row->company_db_host;
            $nestedData[] = $row->company_db_username;
            $nestedData[] = $row->company_db_password;
            $nestedData[] = $row->company_db_database;
            $nestedData[] = Number::currency($row->amount);
            $nestedData[] = date('d-m-Y', strtotime(h($row->start_date)));
            $nestedData[] = date('d-m-Y', strtotime(h($row->end_date)));
            if($row->status == 'Active')
                $nestedData[] = '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Block')
                $nestedData[] = '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Expired')
                $nestedData[] = '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            else if($row->status == 'Renew')
                $nestedData[] = '<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">'.$row->status.'</span>';
            $nestedData[] = '<a title="Edit Subscription" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Subscriptions', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a> <a title="View Subscription" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Subscriptions', 'action' => 'view', enc_dec(1, (String) $row->id)]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
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
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = enc_dec(2, $id);
        $subscription = $this->Subscriptions->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('subscription'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscription = $this->Subscriptions->newEmptyEntity();
        if ($this->request->is('post')) {
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->getData());
            if ($this->Subscriptions->save($subscription)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
        }
        $this->set(compact('subscription'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscription = $this->Subscriptions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->getData());
            if ($this->Subscriptions->save($subscription)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
        }
        $this->set(compact('subscription'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscription = $this->Subscriptions->get($id);
        if ($this->Subscriptions->delete($subscription)) {
            $this->Flash->success(__('The subscription has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
