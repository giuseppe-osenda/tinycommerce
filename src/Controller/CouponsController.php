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
        $product_ids = $this->request->getData('product_ids');

        if (!empty($coupon_code) && !empty($product_ids)) {

            $coupon = $this->Coupons->find('all')->where(['code' => $coupon_code])->first();

            if ($coupon) {
                $coupon_products = $this->Coupons->CouponProducts->find('all')->where(['coupon_id' => $coupon->id])->toArray();

                $coupon_product_ids = array_column($coupon_products, 'product_id');

                $valid_products = array_intersect($product_ids, $coupon_product_ids);

                if (!empty($valid_products)) {
                    $cart['coupon'] = $coupon->toArray();
                    $cart['total_price'] = $cart['total_price'] - $coupon->discount;
                    $session->write('Cart', $cart);
                }
            }
        }
    }
}
