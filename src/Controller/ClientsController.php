<?php

declare(strict_types=1);

namespace App\Controller;

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

            $client = $this->Clients->newEntity($data);


            if ($this->Clients->save($client)) {
                $orders = $this->fetchTable('Orders');
                $order = $orders->newEntity(['client_id' => $client->id, 'total_price' => $cart['total_price']]);
                if ($orders->save($order)) {
                    $resp['success'] = true;
                    $resp['message'] = 'Dati salvati correttamente';
                }else{
                    $resp['success'] = false;
                    $resp['message'] = "Errore nel salvataggio dei dati dell'ordine";
                }
            } else {
                $resp['success'] = false;
                $resp['message'] = 'Errore nel salvataggio dei dati';
            }


            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
