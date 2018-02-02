<?php
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
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth',[
            'authenticate' => [
                'Form' => [
                'fields' => ['username' => 'username', 'password' => 'password']
            ]
            ],
            'loginAction' => [
            'controller' => 'Users',
            'action' => 'login'
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'loginRedirect' => [
            'controller' => 'reservation',
            'action' => 'index'
            ],
            'logoutRedirect' => [
            'controller' => 'users',
            'action' => 'login'
            ],
            'authorize' => ['Controller'], // Added this line
            'unauthorizedRedirect' => $this->referer()
        
        ]);


        

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
    
    public function beforeFilter(Event $event)
    {
       // parent::beforeFilter($event);
        //$this->Auth->allow(['login', 'view', 'display', 'index']);
        $this->Auth->allow(['apirequest', 'message']);
        $this->set([
            'user' => $this->Auth->user()
        ]);
    }

    public function beforeRender(Event $event) {
        //$this->response->header('Access-Control-Allow-Origin', '*');

        $this->response->cors($this->request)
            ->allowOrigin(['*'])
            ->allowMethods(['GET', 'POST'])
            ->allowHeaders(['X-CSRF-Token'])
            ->allowCredentials()
            ->exposeHeaders(['Link'])
            ->maxAge(300)
            ->build();

    }

    public function isAuthorized($user) {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }
    }

}
