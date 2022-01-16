<?php
    declare(strict_types=1);
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Core\Configure;
    use Cake\Http\Exception\ForbiddenException;
    use Cake\Http\Exception\NotFoundException;
    use Cake\Http\Response;
    use Cake\View\Exception\MissingTemplateException;
    use Cake\ORM\Locator\LocatorAwareTrait;
    use Cake\Routing\Router;
    use Cake\Event\EventInterface;
    use Cake\I18n\FrozenTime;
    use Cake\I18n\FrozenDate;

    class ApiController extends AppController
    {
        public function initialize(): void
        {
            parent::initialize();

            $this->loadComponent('RequestHandler');
            $this->loadComponent('Flash');
            $this->loadComponent('Security');

            /*
            * Enable the following component for recommended CakePHP form protection settings.
            * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
            */
            //$this->loadComponent('FormProtection');
            //$this->viewBuilder()->setLayout('default');
        }
        public function beforeFilter(EventInterface $event)
        {
            parent::beforeFilter($event);
            $this->Security->setConfig('unlockedActions', ['*']);
            $this->Security->setConfig('validatePost', false);
        }
        public function index()
        {
            if($this->request->is('post')){
                $request = $this->request->getData();
                $SubscriptionsTable = $this->getTableLocator()->get('Subscriptions');
                $query = $SubscriptionsTable->find()->where([
                    'company_code' => $request['company_code'],
                    'OR' => [['status' => 'Active'], ['status' => 'Renew']],
                ])->first();
                if(!empty($query)){
                    $end_date = new FrozenDate($query->end_date);
                    $dateTime = strtotime($end_date->format('Y-m-d'));
                    $datediff = time() - $dateTime;
				    $query->days_remaining = round($datediff / (60 * 60 * 24));
                    $query->Status = 200;
				    echo json_encode($query);
                }else {
                    echo json_encode(array('Status' => 100,'message' => 'Sorry your company not registered or renewed.'));
                }
                exit;
            }
            echo json_encode(array('status'=>404,'message'=>'Method not allowed'));die;
        }
        public function deviceInfo(){
            if($this->request->is('post')){
                $request = $this->request->getData();
                $app_infoTable = $this->getTableLocator()->get('AppInfo');
                $query = $app_infoTable->find()->where([
                    'IMEI' => $request['device_id'],
                ])->first();
                $save_data = array(
                    'os_version' => $request['os_version'],
                    'product' => $request['product'],
                    'device_name' => $request['device_name'],
                    'model_number' => $request['model_number'],
                    'IMEI' => $request['device_id'],
                    'IP_address' => $request['IP_address'],
                    'NetworkOperatorName' => $request['NetworkOperatorName'],
                    'Package_name' => $request['Package_name'],
                    'Android_version' => $request['Android_version'],
                    'Created'=> date("Y-m-d H:i:s")
                );
                $query1 = $app_infoTable->query();
                if(empty($check_IMEI)){
                    $query1->insert(['os_version','product','device_name','model_number','IMEI','IP_address','NetworkOperatorName','Package_name','Android_version','Created'])
                        ->values($save_data)
                        ->execute();
                    $is_insert = 1;
                } else {
                    $query1->update()
                        ->set($save_data)
                        ->where(['id' => $query->id])
                        ->execute();
                    $is_insert = 2;
                }
                if($is_insert == 1 && $is_insert = 2){
                    echo json_encode(array('status' => 200,'message' => 'Saved Data Successfully.','update_status'=>$is_insert));
                } else {
                    echo json_encode(array('status' => 100,'message' => 'Unable To Save Data.'));
                }
            } else {
                echo json_encode(array('status' => 400,'message' => 'Bad request.'));
            }
            exit;
        }
    }
