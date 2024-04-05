<?php
declare(strict_types=1);

namespace App\Controller;

class CartController extends AppController
{
    
    public function view()
    {   
        $session = $this->request->getSession();
        $cart = $session->read('Cart');

        if (empty($cart)) { //se il carello è vuoto simulo il popolamento con i primi due prodotti attivi

            $products = $this->fetchTable('Products');

            $cartProducts = $products->find('list')->where(['Products.active' => 1])->limit(2)->toArray(); //Recupero i primi due prodotti attivi per popolare il carrello
            
            foreach ($cartProducts as $id => $title) {
                $session->write('Cart.'.$id, $id);
            }
            
        }

        foreach ($cart as $key => $product_id) { //Recupero i prodotti dal carrello
            $product = $this->fetchTable('Products')->get($product_id);
            $products[$key] = $product;
        }

        $this->set(compact('products'));
    }
}