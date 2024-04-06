<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Coupons Controller
 *
 * @property \App\Model\Table\CouponsTable $Coupons
 */
class CouponsController extends AppController
{

    public function apply()
    {
        $this->autoRender = false;

        $session = $this->request->getSession();
        $cart = $session->read('Cart');

        $coupon_code = $this->request->getData('coupon_code');


        if (!empty($coupon_code)) {

            $coupon = $this->Coupons->findByCodeAndActive($coupon_code, 1)->first();

            if ($coupon) {
                
            }
        }
    }
}
