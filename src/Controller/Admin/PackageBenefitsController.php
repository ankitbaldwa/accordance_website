<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PackageBenefits Controller
 *
 * @method \App\Model\Entity\PackageBenefit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackageBenefitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id="")
    {
        $id = enc_dec(2, $id);
        $this->loadModel('Packages');
        $Packages = $this->Packages->get($id);
        $packageBenefits = $this->paginate($this->PackageBenefits);

        $this->set(compact('packageBenefits', 'Packages'));
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
            $nestedData[] = '<a title="Edit Package" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'Packages', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a> | <a title="View Package Benfits" href="'.Router::url(['prefix'=>'Admin','controller' => 'PackageBenefits', 'action' => 'index', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md view"><i class="la la-eye"></i></a>';
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
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packageBenefit = $this->PackageBenefits->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('packageBenefit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packageBenefit = $this->PackageBenefits->newEmptyEntity();
        if ($this->request->is('post')) {
            $packageBenefit = $this->PackageBenefits->patchEntity($packageBenefit, $this->request->getData());
            if ($this->PackageBenefits->save($packageBenefit)) {
                $this->Flash->success(__('The package benefit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
        }
        $this->set(compact('packageBenefit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packageBenefit = $this->PackageBenefits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packageBenefit = $this->PackageBenefits->patchEntity($packageBenefit, $this->request->getData());
            if ($this->PackageBenefits->save($packageBenefit)) {
                $this->Flash->success(__('The package benefit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
        }
        $this->set(compact('packageBenefit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packageBenefit = $this->PackageBenefits->get($id);
        if ($this->PackageBenefits->delete($packageBenefit)) {
            $this->Flash->success(__('The package benefit has been deleted.'));
        } else {
            $this->Flash->error(__('The package benefit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
