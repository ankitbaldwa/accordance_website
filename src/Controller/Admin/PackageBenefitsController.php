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
        $this->set(compact('packageBenefits', 'Packages', 'id'));
    }
    public function ajax($id=""){
        $this->autoRender = false;
        $id = enc_dec(2, $id);
        $requestData= $this->request->getData();
        $columns = array(
            0 => 'PackageBenefits.id',
            1 => 'PackageBenefits.title'
        );
        $order = array('PackageBenefits.id' => 'DESC');
        $page = intval($requestData['start']);
        $offset = intval($requestData['length']);
        $query = $this->getTableLocator()->get('PackageBenefits')
                    ->find()
                    ->select($columns);
        /** For where condition  */
        $i = 0;
        $condition = ['PackageBenefits.package_id'=>$id];
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
            $nestedData[] = $i;
            $nestedData[] = $row->title;
            $nestedData[] = '<a title="Edit Package Benefit" data-url="'.Router::url(['prefix'=>'Admin','controller' => 'PackageBenefits', 'action' => 'edit', $row->id]).'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit"><i class="la la-edit"></i></a>';
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
    public function add($id="")
    {
        $id = enc_dec(2, $id);
        $packageBenefit = $this->PackageBenefits->newEmptyEntity();
        if ($this->request->is('post')) {
            $packageBenefit = $this->PackageBenefits->patchEntity($packageBenefit, $this->request->getData());
            if ($this->PackageBenefits->save($packageBenefit)) {
                $this->Flash->success(__('The package benefit has been saved.'));

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'Package Benefit has been saved successfully!')); exit;
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The package benefit could not be saved. Please, try again.')); exit;
        }
        $this->set(compact('packageBenefit', 'id'));
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

                //return $this->redirect(['action' => 'index']);
                echo JSON_encode(array('status'=>1, 'message'=>'Package Benefit has been updated successfully!')); exit;
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
            echo JSON_encode(array('status'=>2, 'message'=>'The package benefit could not be saved. Please, try again.')); exit;
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
    public function downloadExcel($type, $id = null){
        ini_set('memory_limit', '-1');
        $id = enc_dec(2, $id);
        $PackageBenefits = $this->getTableLocator()->get('PackageBenefits')
                    ->find()->contain(['Packages'])->where(['package_id'=>$id]);
        $spreadsheet = new Spreadsheet();
        //Set document properties
        $spreadsheet->getProperties()
                    ->setCreator('Accordance India')
                    ->setLastModifiedBy($this->request->getSession()->read('Auth.name'))
                    ->setTitle('Package Benefits')
                    ->setSubject('')
                    ->setDescription('')
                    ->setKeywords('')
                    ->setCategory('Package Benefits');
        // Add some data
        $headerArray = ['Id', 'Package', 'Name'];
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $headerArray,   // The data to set
                        NULL,        // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    )
                    ->setTitle('Package Benefits');
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

        $spreadsheet->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $i=2;$counter=0;
        foreach ( $PackageBenefits->all() as $row){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, ++$counter);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $row->package->name);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $row->title);
            $i++;
        }
        ob_end_clean();
        if($type == 'excel'){
            $filename='PackageBenefits.xlsx'; //save our workbook as this file name
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->setPreCalculateFormulas(true);
            //$writer ->save(WWW_ROOT . '/files/ example.xlsx');
            $writer->save('php://output'); // download file
        }
        if($type == 'csv'){
            $filename='PackageBenefits.csv'; //save our workbook as this file name
            $writer = new Csv($spreadsheet);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output'); // download file
        }
        if($type == 'pdf'){
            $filename='PackageBenefits.pdf'; //save our workbook as this file name
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
