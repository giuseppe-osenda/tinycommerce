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

            $email = $data['email'];
            $tax_code = $data['tax_code'];

            $returning_client = $this->Clients->find()->where(['email' => $email, 'tax_code' => $tax_code])->first();

            if (empty($returning_client)) {
                $client = $this->Clients->newEntity($data);

                if ($this->Clients->save($client)) {
                    $orders = $this->fetchTable('Orders');
                    $order = $orders->newEntity(['client_id' => $client->id, 'total_price' => $cart['total_price']]);
                    if ($orders->save($order)) {
                        $resp['success'] = true;
                        $resp['message'] = 'Dati salvati correttamente';
                        $resp['redirectUrl'] = Router::url('/checkout?client_id='.$client->id);
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = "Errore nel salvataggio dei dati dell'ordine";
                    }
                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Errore nel salvataggio dei dati';
                }
            }else{
                $orders = $this->fetchTable('Orders');
                $order = $orders->newEntity(['client_id' => $returning_client->id, 'total_price' => $cart['total_price']]);
                if ($orders->save($order)) {
                    $resp['success'] = true;
                    $resp['message'] = 'Dati salvati correttamente';
                    $resp['redirectUrl'] = Router::url('/checkout?client_id='.$returning_client->id);
                } else {
                    $resp['success'] = false;
                    $resp['message'] = "Errore nel salvataggio dei dati dell'ordine";
                }
            }

            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
