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

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Collection\Collection;
use Cake\Routing\Router;
use Cake\Utility\Hash;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;
use Cake\Core\Configure;
use Cake\Http\Exception\UnauthorizedException;
use Cake\View\JsonView;
use Cake\View\XmlView;

// serve per recuperare il modello
use Cake\Datasource\FactoryLocator;

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
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) // This function is called before every action in the controller
    {
        parent::beforeFilter($event); // Call the parent beforeFilter function

        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        // $this->Authentication->addUnauthenticatedActions(['index', 'view', 'display']); //TODO: perchè il redirect non funziona se lo abilito?

        $identity = $this->getRequest()->getAttribute('identity'); // Get the identity

        if ($identity) { // If the identity exists
            $user = $identity->getOriginalData(); // Get the user data
            $this->set(compact('user')); // Pass the user data to the view
        }
    }

    public function beforeRender(EventInterface $event){
        parent::beforeRender($event);

        $this->viewBuilder()->setLayout('CakeLte.default');
    }
}
