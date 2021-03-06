<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Routing\Router;
use Cake\Mailer\Mailer;
use Cake\Mailer\Email;
use Cake\View\Helper\UrlHelper;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function index(){

    }
    public function view($slug){
        if(empty($slug))
            $this->redirect(["controller"=>"Pages", "action"=>"index"]);
        $page = $this->getTableLocator()->get('Pages');
        $query = $page->find()->where(['slug' => $slug, 'status'=> 'Active']);
        $this->set('page', $query->first());
    }
    public function contact(){

    }
    public function request(){
        $this->viewBuilder()->setLayout('ajax');
        if ($this->request->is('post')) {
            $RequestsTable = $this->getTableLocator()->get('Requests');
            $request = $RequestsTable->newEmptyEntity();
            $request->name = $this->request->getData()['name'];
            $request->email = $this->request->getData()['email'];
            $request->mobile = $this->request->getData()['mobile'];
            $request->message = $this->request->getData()['message'];
            $this->sendMail($request,'request');
            if ($RequestsTable->save($request)) {
                echo JSON_encode(array('status'=>1, 'message'=>'Request has been saved successfully!')); exit;
            }
            echo JSON_encode(array('status'=>2, 'message'=>'The request could not be saved. Please, try again.')); exit;
        }
        exit;
    }
    public function sendMail($data, $type){
        /* $this->viewBuilder()->setLayout('ajax');
        $mailer = new Mailer('default');
        $mailer->setTo('ankitbaldwa1992@gmail.com')
            ->setSubject('About')
            ->deliver('My message');

        Email::deliver('ankitbaldwa1992@gmail.com', 'Subject', 'Message', ['from' => 'no-reply@accordance.co.in','replyTo'=>'b.ankit@accordance.co.in']); */
        $mailBodies = $this->getTableLocator()->get('MailBodies');
        $query = $mailBodies->find()->where(['type' => $type])->first();

        $settings = $this->getTableLocator()->get('Settings')->find()->toArray();

        $mailSubject = $query->subject;
        $mailBody = $query->body;

        $mailBody = str_replace('{name}',$data->name, $mailBody);
        $mailBody = str_replace('{email}',$data->email, $mailBody);
        $mailBody = str_replace('{mobile}',$data->mobile, $mailBody);
        $mailBody = str_replace('{message}',$data->message, $mailBody);

        $mailBody = str_replace('{prop_name}',$settings[0]->value, $mailBody);
        $mailBody = str_replace('{phone}',$settings[2]->value, $mailBody);
        $mailBody = str_replace('{company_email}',$settings[4]->value, $mailBody);
        $mailBody = str_replace('{company_address}',$settings[1]->value, $mailBody);
        $mailBody = str_replace('{logo}',Router::url('/').'img/'.$settings[5]->value,$mailBody);

        $mailer = new Mailer();
        $mailer->setDomain('www.accordance.co.in');
        $mailer->setTransport('default');
        $mailer
            ->setEmailFormat('both')
            ->setTo($data->email)
            ->setBcc('ankitbaldwa1992@gmail.com')
            ->setReplyTo('b.ankit@accordance.co.in')
            ->setFrom('no-reply@accordance.co.in')
            ->setSubject($mailBody)
            ->viewBuilder()
                ->setTemplate('default')
                ->setLayout('default');
        $result = $mailer->deliver($mailBody);
        //pr($result);die;
    }
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
