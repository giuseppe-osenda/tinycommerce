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

    //Funzione per applicare un coupon
    public function apply()
    {
        $this->autoRender = false; // Disabilita il rendering automatico della vista

        $coupon_code = $this->request->getData('coupon_code'); //Recupero il codice coupon dalla richiesta

        if (!empty($coupon_code)) { //Se il codice coupon non è vuoto

            $resp = [];

            $coupon = $this->Coupons->findByCodeAndActive($coupon_code, 1)->first(); //Recupero il coupon attivo

            $this->updateProductCoupons(); //Aggiorno i coupon sui prodotti prima di applicare il coupon al carrello
            $session = $this->request->getSession();
            $cart = $session->read('Cart');

            $min_price = false;
            $max_price = false;

            if (!empty($coupon)) { //Se il coupon esiste
                $min_price = $coupon->min_price <= $cart['total_price']; //Controllo se il totale del carrello è maggiore o uguale al prezzo minimo del coupon
                if ($coupon->max_price != null) { //Se il prezzo massimo del coupon non è nullo
                    $max_price = $coupon->max_price >= $cart['total_price']; //Controllo se il totale del carrello è minore o uguale al prezzo massimo del coupon
                } else {
                    $max_price = true; //Se il prezzo massimo del coupon è nullo, il controllo è superato
                }
            }

            if (!empty($coupon) && $min_price && $max_price && !$cart['has_used_coupon']) { //Se il coupon esiste, il totale del carrello è maggiore o uguale al prezzo minimo del coupon, il totale del carrello è minore o uguale al prezzo massimo del coupon e non è stato già utilizzato un coupon

                $at_least_one_product = false; //Flag per verificare se almeno un prodotto ha il coupon applicato

                foreach ($cart as $product_id => $val) {
                    if (is_array($val)) { //Se l'elemento è un array alloro è un prodotto
                        if ($cart[$product_id]['coupon_id'] == $coupon->id) {
                            $at_least_one_product = true;
                            $cart[$product_id]['price'] -= $cart[$product_id]['price'] * $coupon->discount / 100;
                            $cart[$product_id]['row_total'] = $cart[$product_id]['price'] * $cart[$product_id]['quantity'];
                            $resp[$product_id] = ['rowTotal' => $cart[$product_id]['row_total'], 'price' => $cart[$product_id]['price']]; //Aggiorno il totale del prodotto con lo sconto applicato da passare nella risposta
                        }
                    }
                }

                if (!$at_least_one_product) { //Se nessun prodotto è eleggibile per il coupon
                    $error = "Il coupon inserito non è valido per i prodotti nel carrello"; //Messaggio di errore
                    $resp['message'] = $error;
                    $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                        ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
                    $this->set('resp', $resp);
                    return;
                }

                $cart['total_price'] = array_sum(array_column($cart, 'row_total')); //Calcolo il totale del carrello sommando i totali di tutti i prodotti

                $session->write('Cart', $cart); //Salvo il carrello aggiornato nella sessione
                $session->write('Cart.total_price', $cart['total_price']); //Salvo il totale del carrello nella sessione
                $session->write('Cart.has_used_coupon', true); //Salvo il flag che indica che è stato utilizzato un coupon
                $session->write('Cart.coupon_code', $coupon['code']); //Salvo il codice del coupon utilizzato
                $session->write('Cart.coupon_id', $coupon['id']); //Salvo l'id del coupon utilizzato

                $resp['success'] = true;
                $resp['message'] = "Coupon applicato con successo!";
                $resp['cartTotal'] = ['cartTotal' => $cart['total_price']]; //Aggiorno il totale del carrello con lo sconto applicato da passare nella risposta
                $resp['couponCode'] = $coupon['code']; //Aggiorno il codice del coupon con lo sconto applicato da passare nella risposta

            } else if ($cart['has_used_coupon']) { //Se è già stato utilizzato un coupon
                $error = "Hai già utilizzato un coupon";
                $resp['message'] = $error;
            } else if (!empty($coupon) && !$min_price) { //Se il coupon esiste e il totale del carrello è minore del prezzo minimo del coupon
                $error = "Il coupon deve essere utilizzato per un importo minimo di " . $coupon->min_price . "€";
                $resp['message'] = $error;
            } else if (!empty($coupon) && !$max_price) { //Se il coupon esiste e il totale del carrello è maggiore del prezzo massimo del coupon
                $error = "Il coupon deve essere utilizzato per un importo massimo di " . $coupon->max_price . "€";
                $resp['message'] = $error;
            } else if (empty($coupon)) { //Se il coupon non esiste
                $error = "Il coupon inserito non è valido";
                $resp['message'] = $error;
            } else { //Se non è stato possibile applicare il coupon
                $error = "Ops qualcosa è andato storto, contatta l'assistenza";
                $resp['message'] = $error;
            }

            $this->response = $this->response->withType('application/json') // Imposta il tipo di risposta su 'application/json'
                ->withStringBody(json_encode($resp)); // Imposta il corpo della risposta
            $this->set('resp', $resp);
        }
    }
}
