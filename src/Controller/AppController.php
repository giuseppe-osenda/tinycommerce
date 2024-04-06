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
use Cake\Event\EventInterface;
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

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $session = $this->request->getSession();

        if (!$session->check('Cart')) {
            $session->write('Cart');
        }

    }

    public function beforeRender(EventInterface $event){
        parent::beforeRender($event);

        $this->viewBuilder()->setLayout('Default');
    }

    public function updateProductCoupons()
    {
        $session = $this->request->getSession();

        if ($session->check('Cart')) {

            $cart = $session->read('Cart');
            $total_price = $session->read('Cart.total_price');
            $has_used_coupon = $session->read('Cart.has_used_coupon');

            unset($cart['total_price']);
            unset($cart['has_used_coupon']);

            $productsTable = $this->getTableLocator()->get('Products');

            foreach ($cart as $product_id => $val) {
                $product_coupon_id = $productsTable->getCouponId($product_id);
                $cart[$product_id]['coupon_id'] = $product_coupon_id;
            }

            $session->write('Cart', $cart);
            $session->write('Cart.total_price', $total_price);
            $session->write('Cart.has_used_coupon', $has_used_coupon);
        }
    }
}
