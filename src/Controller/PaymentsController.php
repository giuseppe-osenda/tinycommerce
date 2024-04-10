<?php

declare(strict_types=1);

namespace App\Controller;


use Cake\Datasource\FactoryLocator;

class PaymentsController extends AppController
{

    public function req()
    {
        if (!empty($this->request->getData())) {
            $data = $this->request->getData();
            $cart = $this->request->getSession()->read('Cart');
            $payment_type = $data['payment_type'];
            $client_id = $data['client_id'];
            $invoice = $data['invoice'];
            $order_address = $data['order_address'];

            if ($payment_type == 'stripe') {

                $stripe = new \Stripe\StripeClient('sk_test_51HvjfMECzoeV8ioG6O7jvGvhr1eCYC2kZb0qyYwVOlIgrnv0IZjVpQeqBiqwwKIHSZBiHJFGT7xkvBwtdDhn485100rdCS0p5N');

                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => round($cart['total_price'] * 100),
                    'currency' => 'eur',
                    'automatic_payment_methods' => ['enabled' => true],
                ]);

                $this->set(compact('paymentIntent', 'client_id', 'invoice', 'order_address'));
            }
        }
    }

    public function complete()
    {
        //aggiorna l'order con lo stato completato con una query al db
        $cart = $this->request->getSession()->read('Cart');
        $client_id = $this->request->getQuery('client_id');
        $invoice = $this->request->getQuery('invoice');
        $order_address = $this->request->getQuery('order_address');

        $orders_table = $this->fetchTable('Orders');
        $order = $orders_table->newEntity(['client_id' => $client_id, 'total_price' => $cart['total_price'], 'invoice' => $invoice, 'order_address' => $order_address, 'complete' => 1]);

        if ($orders_table->save($order)) {
            //salvo l'ordine e i prodotti dell'ordine nella tabella order_products
            $order_products_table = $this->fetchTable('OrderProducts');
            foreach ($cart as $id => $product) {
                if (is_array($product)) { //se l'elemento è un array allora è un prodotto
                    if ($id != 'total_price' && $id != 'has_used_coupon') {
                        $order_products = $order_products_table->newEntity(['order_id' => $order->id, 'product_id' => $id, 'qty' => $product['quantity']]);
                        if ($order_products_table->save($order_products)) {
                            $resp['success'] = true;
                            $resp['message'] = 'OrderProducts salvati correttamente';
                        } else {
                            $resp['success'] = false;
                            $resp['message'] = "Errore nel salvataggio degli OrderProducts";
                        }
                    }
                }
            }
        } else {
            $resp['success'] = false;
            $resp['message'] = "Errore nel salvataggio dei dati dell'ordine";
        }

        if ($resp['success']) {
            $this->request->getSession()->delete('Cart');
            $this->request->getSession()->delete('Cart.total_price');
            $this->request->getSession()->delete('Cart.has_used_coupon');
            $this->redirect('/');
        }
    }
}
