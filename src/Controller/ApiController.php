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
                $clientIp = $this->request->clientIp();
                echo $clientIp;
                pr($this->request->getData());die;
            }
            echo json_encode(array('status'=>404,'message'=>'Method not allowed'));die;
        }
        public function device_info(){

        }
    }
