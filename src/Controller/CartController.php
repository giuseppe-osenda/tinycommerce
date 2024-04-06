<?php

declare(strict_types=1);

namespace App\Controller;

class CartController extends AppController
{

    public function view()
    {
        $session = $this->request->getSession();

        $cart = $session->read('Cart');

        unset($cart['total_price']); //Rimuovo il totale del carrello per calcolarlo nuovamente
        
        if (empty($cart)) { //se il carello è vuoto simulo il popolamento con i primi due prodotti attivi

            $products = $this->fetchTable('Products');

            $cartProducts = $products->find('all')->where(['Products.active' => 1])->limit(2)->toArray(); //Recupero i primi due prodotti attivi per popolare il carrello

            $total_price = 0;
            
            foreach ($cartProducts as $cartProduct) {
                $product_price = floor((float)$cartProduct['price']);
                $total_price += $product_price;
                $cart[$cartProduct['id']] = ['id' => $cartProduct['id'], 'quantity' => '1', 'price' => $product_price, 'row_total' => $product_price, 'name' => $cartProduct['name'], 'stock_qty' => $cartProduct['stock_qty']]; //Popolo il carrello con i primi due prodotti attivi e una quantità di default a 1
            }
            
            $session->write('Cart', $cart);
            $session->write('Cart.total_price', $total_price);
        }

        $cart = $session->read('Cart');

        $this->set('cartItems', $cart);
    }

    public function updateQuantity()
    {
        $this->autoRender = false;

        $error_message = 'Ops! Qualcosa è andato storto...';
        $resp = [];

        $productId = $this->request->getData('id'); //Recupero l'id del prodotto dalla richiesta
        $quantity = $this->request->getData('quantity'); //Recupero la quantità dalla richiesta

        if (!empty($productId) && !empty($quantity)) {
            $session = $this->request->getSession();
            $cart = $session->read('Cart');

            if ($cart && array_key_exists($productId, $cart)) {
                $cart[$productId]['quantity'] = $quantity;
                $cart[$productId]['row_total'] = $quantity * $cart[$productId]['price']; //Calcolo il totale del prodotto
                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti

                $session->write('Cart', $cart);

                $resp = ['success' => true, 'rowTotal' => $cart[$productId]['row_total'], 'cartTotal' =>  $cart['total_price']];
            } else {
                $resp = ['error' => $error_message];
            }
        } else {
            $resp = ['error' => $error_message];
        }

        $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
            ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
        $this->set('resp', $resp);

    }

    public function deleteFromCart($id = null)
    {
        $this->autoRender = false; // Disabilita il rendering automatico della vista

        $error_message = 'Impossibile rimuove il prodotto dal carrello';
        $resp = [];

        if ($id) {
            $session = $this->request->getSession();
            $cart = $session->read('Cart');

            if ($cart && array_key_exists($id, $cart)) {
                unset($cart[$id]);
                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti rimanenti
                $session->write('Cart', $cart);
                $resp = ['success' => true, 'cartTotal' =>  $cart['total_price']];
            } else {
                $resp = ['error' => $error_message];
            }
        } else {
            $resp = ['error' => $error_message];
        }

        $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
            ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
        $this->set('resp', $resp);
    }
}
