<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Router;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    $routes->resources('Api');
});

$routes->scope('/', function (RouteBuilder $builder) {
    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    // Register scoped middleware for in scopes.
    //$builder->applyMiddleware('csrf');
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'index', 'home'],['_name'=> 'Home']);
    $builder->connect('/request', ['controller' => 'Pages', 'action' => 'request'],['_name'=> 'request']);
    $builder->connect('/contact', ['controller' => 'Pages', 'action' => 'contact'],['_name'=> 'contact']);
    $builder->connect(
        '/pages/{slug}',
        ['controller' => 'Pages', 'action' => 'view'],
    )->setPass(['slug']);
    $builder->connect('/login', ['controller' => 'Users', 'action' => 'login'],['_name'=> 'login']);
    $builder->connect('api/weburl', ['controller' => 'Api', 'action' => 'index'],['_name'=> 'weburl']);

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    //$builder->connect('/pages/*', 'Pages::index');

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *
 *     // Parse specified extensions from URLs
 *     // $builder->setExtensions(['json', 'xml']);
 *
 *     // Connect API actions here.
 * });
 * ```
 */
$routes->prefix('admin', function (RouteBuilder $routes) {
    $routes->connect('/', ['prefix'=>'Admin','controller' => 'Users', 'action' => 'login','plugin'=>null]);
    $routes->connect('/dashboard', ['prefix'=>'Admin','controller' => 'Users', 'action' => 'dashboard','plugin'=>null]);
    $routes->connect('/packages', ['prefix'=>'Admin','controller' => 'Packages', 'action' => 'index','plugin'=>null], ['_name' => 'package']);
    $routes->connect('/payments', ['prefix'=>'Admin','controller' => 'Payments', 'action' => 'index','plugin'=>null], ['_name'=>'payments']);
    $routes->connect('/subscriptions', ['prefix'=>'Admin','controller' => 'Subscriptions', 'action' => 'index','plugin'=>null], ['_name'=>'subscriptions']);
    $routes->connect('/requests', ['prefix'=>'Admin','controller' => 'Requests', 'action' => 'index','plugin'=>null], ['_name'=>'requests']);
    $routes->connect('/enquires', ['prefix'=>'Admin','controller'=>'Enquiries','action'=>'index','plugin'=>null],['_name'=>'enquires']);
    $routes->connect('/contacts', ['prefix'=>'Admin','controller'=>'Contacts','action'=>'index','plugin'=>null],['_name'=>'contacts']);
    $routes->connect('/users', ['prefix'=>'Admin','controller'=>'Users','action'=>'index','plugin'=>null],['_name'=>'users']);
    $routes->connect('/pages', ['prefix'=>'Admin','controller'=>'Pages','action'=>'index','plugin'=>null],['_name'=>'pages']);
    $routes->connect('/settings', ['prefix'=>'Admin','controller'=>'Settings','action'=>'index','plugin'=>null],['_name'=>'settings']);
    $routes->plugin('LocationManager', ['path' => '/location-manager'], function (RouteBuilder $routes) {
        // Routes connected here are prefixed with '/debugger' and
        // have the plugin route element set to 'DebugKit'.
        $routes->connect('/{controller}');
        $routes->fallbacks(DashedRoute::class);
    });
     /** Routes for countries plugin master */
        $routes->connect('/location-countries', ['controller' => 'MstCountries','action'=>'index']);
        $routes->connect('/location-countries/add', ['controller' => 'MstCountries','action'=>'add']);
        $routes->connect('/location-countries-view/{id}', ['controller' => 'MstCountries', 'action' => 'view']);
        $routes->connect('/location-countries-update/{id}', ['controller' => 'MstCountries', 'action' => 'update']);
        /** Routes for states plugin master */
        $routes->connect('/location-states', ['controller' => 'MstStates','action'=>'index']);
        $routes->connect('/location-states/add', ['controller' => 'MstStates','action'=>'add']);
        $routes->connect('/location-states/{id}', ['controller' => 'MstStates', 'action' => 'view']);
        $routes->connect('/location-states/{id}', ['controller' => 'MstStates', 'action' => 'update']);
        /** Routes for cities plugin master */
        $routes->connect('/location-cities', ['controller' => 'MstCities','action'=>'index']);
        $routes->connect('/location-cities/add', ['controller' => 'MstCities','action'=>'add']);
        $routes->connect('/location-cities/{id}', ['controller' => 'MstCities', 'action' => 'view']);
        $routes->connect('/location-cities/{id}', ['controller' => 'MstCities', 'action' => 'update']);

    $routes->fallbacks(DashedRoute::class);
});
