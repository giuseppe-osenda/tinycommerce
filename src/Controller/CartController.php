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
        unset($cart['has_used_coupon']); //Rimuovo il flag che indica se è stato già utilizzato un coupon
        unset($cart['coupon_code']); //Rimuovo il codice coupon
        unset($cart['coupon_id']); //Rimuovo l'id del coupon

        if (empty($cart)) { //se il carello è vuoto simulo il popolamento con i primi due prodotti attivi

            $session->delete('original_prices');
            $session->delete('original_total');

            $products = $this->fetchTable('Products');

            $cartProducts = $products->find('all')->where(['Products.active' => 1])->toArray(); //Recupero i primi due prodotti attivi per popolare il carrello

            $total_price = 0;

            $product_prices = [];

            foreach ($cartProducts as $cartProduct) {
                $product_price = number_format((float)$cartProduct['price'], 2, '.', '');
                $total_price += $product_price;
                $cart[$cartProduct['id']] = ['id' => $cartProduct['id'], 'quantity' => '1', 'price' => $product_price, 'original_price' => $product_price, 'row_total' => $product_price, 'name' => $cartProduct['name'], 'stock_qty' => $cartProduct['stock_qty'], 'coupon_id' => $cartProduct['coupon_id']]; //Popolo il carrello con i primi due prodotti attivi e una quantità di default a 1
                $product_prices[$cartProduct['id']] = $product_price;
            }

            $session->write('Cart', $cart);
            $session->write('Cart.total_price', $total_price);
            $session->write('Cart.has_used_coupon', false);
            $session->write('original_prices', $product_prices); //Salvo i prezzi originali dei prodotti
            $session->write('original_total', $total_price); //Salvo il totale originale del carrello
        }

        $cart = $session->read('Cart');


        $this->set('cartItems', $cart);
    }

    //Funzione per aggiornare la quantità di un prodotto nel carrello
    public function updateQuantity()
    {
        $this->autoRender = false; // Disabilita il rendering automatico della vista

        $error_message = 'Ops! Qualcosa è andato storto...'; //Messaggio di errore di default
        $resp = []; //Inizializzo la risposta

        $productId = $this->request->getData('id'); //Recupero l'id del prodotto dalla richiesta
        $quantity = $this->request->getData('quantity'); //Recupero la quantità dalla richiesta

        if (!empty($productId) && !empty($quantity)) { //Controllo che l'id del prodotto e la quantità non siano vuoti
            $session = $this->request->getSession();
            $cart = $session->read('Cart');

            if ($cart && array_key_exists($productId, $cart)) { //Controllo che il prodotto sia presente nel carrello
                $cart[$productId]['quantity'] = $quantity; //Aggiorno la quantità del prodotto
                $cart[$productId]['row_total'] = $quantity * number_format((float)$cart[$productId]['price'], 2, '.', ''); //Calcolo il totale del prodotto
                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti

                $session->write('Cart', $cart); //Salvo il carrello aggiornato nella sessione
                $session->write('original_total', $cart['total_price']); //Salvo il totale originale del carrello da mostrare se uso un coupon

                $resp = ['success' => true, 'rowTotal' => $cart[$productId]['row_total'], 'cartTotal' =>  $cart['total_price']]; //Preparo la risposta
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

    //Funzione per rimuovere un prodotto dal carrello
    public function deleteFromCart($id = null)
    {
        $this->autoRender = false; // Disabilita il rendering automatico della vista

        $error_message = 'Impossibile rimuove il prodotto dal carrello';
        $resp = [];

        if ($id != null) {
            $session = $this->request->getSession();
            $cart = $session->read('Cart');
            $coupon_id = $this->request->getSession()->read('Cart.coupon_id'); // leggo l'id del coupon dalla sessione

            if ($cart && array_key_exists($id, $cart)) { //Controllo che il prodotto sia presente nel carrello
                unset($cart[$id]); //Rimuovo il prodotto dal carrello
                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti rimanenti
                $session->write('Cart', $cart); //Salvo il carrello aggiornato nella sessione

                $at_least_one_product = false; //Flag per verificare se almeno un prodotto ha il coupon applicato
                $cart = $session->read('Cart'); // leggo il carrello dalla sessione aggiornato
                $session->write('original_total', array_sum(array_column($cart, 'original_price'))); //Aggiorno il totale originale del carrello

                foreach ($cart as $product_id => $cartItem) {
                    if (is_array($cartItem)) { //Se l'elemento è un array allora è un prodotto
                        $product_prices[$product_id] = $cartItem['original_price']; //Aggiorno i prezzi originali dei prodotti
                        $session->write('original_prices', $product_prices); //Scrivo i prezzi originali dei prodotti aggiornati in sessione

                        if (isset($coupon_id)) { //Se è stato usato un coupon
                            if ($cartItem['coupon_id'] == $coupon_id) { //Controllo se almeno un prodotto ha il coupon applicato
                                $at_least_one_product = true; //Imposto il flag a true
                            }
                        }
                    }
                }

                $original_total = $session->read('original_total');
                $resp = ['success' => true, 'cartTotal' =>  $cart['total_price'], 'atLeastOneProduct' => $at_least_one_product, 'originalTotal' => $original_total]; //Preparo la risposta con il totale del carrello aggiornato, il flag che indica se almeno un prodotto ha il coupon applicato e il totale originale del carrello

                //Se il carrello è vuoto lo passo alla vista per disabilitare il bottone procedi
                unset($cart['total_price']);
                unset($cart['has_used_coupon']);
                $empty_cart = empty($cart);
                $resp['emptyCart'] = $empty_cart;
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
