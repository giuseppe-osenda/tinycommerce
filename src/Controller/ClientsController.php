<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Routing\Router;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    public function view()
    {
        $session = $this->request->getSession();

        $cart = $session->read('Cart');

        $this->set(compact('cart'));
    }

    public function req()
    {
        $this->autoRender = false;
        $resp = [];


        if (!empty($this->request->getData())) {
            $data = $this->request->getData();
            $cart = $this->request->getSession()->read('Cart');

            $invoice = $data['invoice'];
            unset($data['invoice']); // Rimuove il campo invoice dai dati del cliente perchè non è un campo della tabella clients
            $email = $data['email'];
            $tax_code = $data['tax_code'];
            $order_address = $data['address'];

            $returning_client = $this->Clients->find()->where(['email' => $email])->first();

            if (empty($returning_client)) {
                $client = $this->Clients->newEntity($data);

                if ($this->Clients->save($client)) {
                    $orders_table = $this->fetchTable('Orders');
                    $order = $orders_table->newEntity(['client_id' => $client->id, 'total_price' => $cart['total_price'], 'invoice' => $invoice, 'order_address' => $order_address]);

                    if ($orders_table->save($order)) {
                        $resp['success'] = true;
                        $resp['message'] = 'Dati salvati correttamente';
                        //salvo l'ordine e i prodotti dell'ordine nella tabella order_products
                        $order_products_table = $this->fetchTable('OrderProducts');
                        foreach ($cart as $id => $product) {
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
                        if ($resp['success']) {
                            $resp['redirectUrl'] = Router::url('/checkout?client_id=' . $client->id);
                        }
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = "Errore nel salvataggio dei dati dell'ordine";
                    }
                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Errore nel salvataggio dei dati';
                }
            } else {
                $returning_client = $this->Clients->patchEntity($returning_client, $data); // Aggiorna i dati del cliente

                if ($this->Clients->save($returning_client)) {
                    $orders_table = $this->fetchTable('Orders');
                    $order = $orders_table->newEntity(['client_id' => $returning_client->id, 'total_price' => $cart['total_price'], 'invoice' => $invoice, 'order_address' => $order_address]);
                    if ($orders_table->save($order)) {
                        $resp['success'] = true;
                        $resp['message'] = 'Ordine cliente di ritorno salvato correttamente';
                        //salvo l'ordine e i prodotti dell'ordine nella tabella order_products
                        $order_products_table = $this->fetchTable('OrderProducts');
                        foreach ($cart as $id => $product) {
                            if ($id != 'total_price' && $id != 'has_used_coupon') {
                                $order_products = $order_products_table->newEntity(['order_id' => $order->id, 'product_id' => $id, 'qty' => $product['quantity']]);
                                if ($order_products_table->save($order_products)) {
                                    $resp['success'] = true;
                                    $resp['message'] = 'OrderProducts cliente di ritorno salvati correttamente';
                                } else {
                                    $resp['success'] = false;
                                    $resp['message'] = "Errore nel salvataggio degli OrderProducts cliente di ritorno";
                                }
                            }
                        }
                        if ($resp['success']) {
                            $resp['redirectUrl'] = Router::url('/checkout?client_id=' . $returning_client->id);
                        }
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = "Errore nel salvataggio dei dati dell'ordine cliente di ritorno";
                    }
                } else {
                    $resp['success'] = false;
                    $resp['message'] = "Errore nell'aggiornamento dei dati del cliente cliente di ritorno";
                }
            }

            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
