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

        $coupon_code = $this->request->getData('coupon_code');

        if (!empty($coupon_code)) {

            $resp = [];

            $coupon = $this->Coupons->findByCodeAndActive($coupon_code, 1)->first(); //Recupero il coupon attivo

            $this->updateProductCoupons(); //Aggiorno i coupon sui prodotti
            $session = $this->request->getSession();
            $cart = $session->read('Cart');

            $min_price = false;
            $max_price = false;

            if (!empty($coupon)) {
                $min_price = $coupon->min_price <= $cart['total_price'];
                $max_price = $coupon->max_price >= $cart['total_price'];
            }

            if (!empty($coupon) && $min_price && $max_price && !$cart['has_used_coupon']) {

                unset($cart['total_price']); //Rimuovo il totale del carrello per calcolarlo nuovamente
                unset($cart['has_used_coupon']); //Rimuovo il flag che indica se è stato già utilizzato un coupon

                foreach ($cart as $product_id => $val) {
                    if ($cart[$product_id]['coupon_id'] == $coupon->id) {
                        $cart[$product_id]['price'] -= $cart[$product_id]['price'] * $coupon->discount / 100;
                        $cart[$product_id]['row_total'] = $cart[$product_id]['price'] * $cart[$product_id]['quantity'];
                        $resp[$product_id] = ['rowTotal' => $cart[$product_id]['row_total'], 'price' => $cart[$product_id]['price']]; //Aggiorno il totale del prodotto con lo sconto applicato da passare nella risposta
                    }
                }

                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti

                $session->write('Cart', $cart);
                $session->write('Cart.total_price', $cart['total_price']);
                $session->write('Cart.has_used_coupon', true);

                $resp['success'] = true;
                $resp['message'] = "Coupon applicato con successo!";
                $resp['cartTotal'] = ['cartTotal' => $cart['total_price']]; //Aggiorno il totale del carrello con lo sconto applicato da passare nella risposta

                $cart['has_used_coupon'] = true;
            } else if (!empty($coupon) && !$min_price) {
                $error = "Il coupon deve essere utilizzato per un importo minimo di " . $coupon->min_price . "€";
                $resp['message'] = $error;
            } else if (!empty($coupon) && !$max_price) {
                $error = "Il coupon deve essere utilizzato per un importo massimo di " . $coupon->max_price . "€";
                $resp['message'] = $error;
            } else if ($cart['has_used_coupon']) {
                $error = "Hai già utilizzato un coupon";
                $resp['message'] = $error;
            } else if(empty($coupon)){
                $error = "Il coupon inserito non è valido";
                $resp['message'] = $error;
            } else {
                $error = "Il coupon inserito non è valido";
                $resp['message'] = $error;
            }

            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
