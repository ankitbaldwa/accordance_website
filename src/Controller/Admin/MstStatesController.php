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
 * MstStates Controller
 *
 * @property \App\Model\Table\MstStatesTable $MstStates
 * @method \App\Model\Entity\MstState[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MstStatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        /*$this->paginate = [
            'contain' => ['MstCountries'],
        ];*/
        //$mstStates = $this->paginate($this->MstStates);

        //$this->set(compact('mstStates'));
    }

    public function ajax(){
        $this->autoRender = false;
        $requestData= $this->request->getData();

        $columns = array(
            0 => 'MstStates.id',
            1 => 'MstCountries.country_name',
            2 => 'MstStates.state_name',
            3 => 'MstStates.status',
        );
        $order = array('MstStates.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('MstStates')
                    ->find()
                    ->select($columns);
        $query->contain(['MstCountries']);
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
            $nestedData[] = $row->mst_country->country_name;
            $nestedData[] = (!empty($row->state_name))?$row->state_name:'-';
            if($row->status == 'Active')
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'MstStates', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">'.$row->status.'</span></a>';
            else
                $nestedData[] = '<a title="Status" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'MstStates', 'action' => 'status', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md status"><span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">'.$row->status.'</span></a>';
            $nestedData[] = '<a title="Edit State" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'MstStates', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a>';
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
     * @param string|null $id Mst State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mstState = $this->MstStates->get($id, [
            'contain' => ['MstCountries', 'MstCities'],
        ]);

        $this->set(compact('mstState'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mstState = $this->MstStates->newEmptyEntity();
        if ($this->request->is('post')) {
            $mstState = $this->MstStates->patchEntity($mstState, $this->request->getData());
            if ($this->MstStates->save($mstState)) {
                $this->Flash->success(__('The mst state has been saved.'));

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'State has been saved successfully!')); exit;
            }
            $this->Flash->error(__('The mst state could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The state could not be saved. Please, try again.')); exit;
        }
        $mstCountries = $this->MstStates->MstCountries->find('list', ['keyField' => 'id','valueField'=>'country_name']);
        $this->set(compact('mstState', 'mstCountries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mst State id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mstState = $this->MstStates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mstState = $this->MstStates->patchEntity($mstState, $this->request->getData());
            if ($this->MstStates->save($mstState)) {
                $this->Flash->success(__('The mst state has been saved.'));

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'State has been updated successfully!')); exit;
            }
            $this->Flash->error(__('The mst state could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The state could not be saved. Please, try again.')); exit;
        }
        $mstCountries = $this->MstStates->MstCountries->find('list', ['keyField' => 'id','valueField'=>'country_name']);
        $this->set(compact('mstState', 'mstCountries'));
    }
    /**
     * Change status method
     * @param string|null $id Mst State id.
     */
    public function status($id = null){
        if ($this->request->is(['post'])) {
            $MstStatesTable = $this->getTableLocator()->get('MstStates');
            $state = $MstStatesTable->get($id); // Return state with id

            $state->status = $this->request->getData()['status'];
            $MstStatesTable->save($state);
            echo 1;exit;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Mst State id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mstState = $this->MstStates->get($id);
        if ($this->MstStates->delete($mstState)) {
            $this->Flash->success(__('The mst state has been deleted.'));
        } else {
            $this->Flash->error(__('The mst state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function downloadExcel($type){
        $states = $this->getTableLocator()->get('MstStates')
                    ->find()->contain(['MstCountries']);
        $spreadsheet = new Spreadsheet();
        //Set document properties 
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('States')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('Location');
        // Add some data 
        $headerArray = ['Id', 'Country Name', 'State Name'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('States');
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
        //$spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $i=2;
        foreach ( $states->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $row->id);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->mst_country->country_name);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $row->state_name);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='States.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='States.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='States.pdf'; //save our workbook as this file name
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
