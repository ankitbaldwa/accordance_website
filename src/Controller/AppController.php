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

use Cake\Controller\Controller;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
        $this->viewBuilder()->setLayout('default');
    }
    public function beforeRender(\Cake\Event\EventInterface $event){
        $main = $this->_getData('Main')->first();
        $footer = $this->_getData('Footer')->all();
        $product = $this->_getProducts(1)->all();
        $testimonial = $this->_getTestimonials(1)->all();
        $product_count = $this->_getProducts(1)->count();
        $pricing = $this->_getPricing()->all();
        //pr($pricing);die;
        $this->set(compact('main', 'footer', 'product','product_count', 'testimonial','pricing'));
    }
    protected function _getData($type){
        $page = $this->getTableLocator()->get('Pages');
        $query = $page->find()->select(['id', 'slug', 'title']);
        $query->where(['type' => $type, 'status'=> 'Active']);
        return $query;
    }
    protected function _getProducts($status){
        $product = $this->getTableLocator()->get('products');
        $query = $product->find()->select(['id', 'name', 'slug']);
        $query->where(['status'=> $status]);
        return $query;
    }
    protected function _getTestimonials($status){
        $testimonial = $this->getTableLocator()->get('testimonials');
        $query = $testimonial->find()->select(['id', 'name', 'detail']);
        $query->where(['status'=> $status]);
        return $query;
    }
    protected function _getPricing(){
        $pricing = $this->getTableLocator()->get('Packages');
        $query = $pricing->find()->select(['Packages.id','Packages.name','Packages.currency','Packages.net_amount','Packages.is_monthly','Packages.status'])->contain('PackageBenefits');
        $query->where(['Packages.status'=>'Buy Now']);
        return $query;
    }
}
