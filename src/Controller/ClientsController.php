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
            $order_address = $data['address'];

            $returning_client = $this->Clients->find()->where(['email' => $email])->first();

            if (empty($returning_client)) { // Se non esiste un cliente con la stessa email
                $client = $this->Clients->newEntity($data); // Crea un nuovo cliente

                if ($this->Clients->save($client)) {
                    $resp['success'] = true;
                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Controlla di aver inserito tutti i campi obbligatori';
                }

                if ($resp['success']) {
                    $resp['redirectUrl'] = Router::url('/checkout?client_id=' . $client->id . '&invoice=' . $invoice . '&order_address=' . $order_address);
                }
            } else {
                $returning_client = $this->Clients->patchEntity($returning_client, $data); // Aggiorna i dati del cliente

                if ($this->Clients->save($returning_client)) {
                    $resp['success'] = true;
                } else {
                    $resp['success'] = false;
                    $resp['message'] = "Controlla di aver inserito tutti i campi obbligatori";
                }

                if ($resp['success']) {
                    $resp['redirectUrl'] = Router::url('/checkout?client_id=' . $returning_client->id. '&invoice=' . $invoice . '&order_address=' . $order_address);
                }
            }



            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
