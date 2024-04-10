<?php

use Cake\Datasource\FactoryLocator;

$client_id = $this->request->getQuery('client_id');
$invoice = $this->request->getQuery('invoice');
$order_address = $this->request->getQuery('order_address');
$client = null;
if (!empty($client_id)) {
    $client = FactoryLocator::get('Table')->get('Clients')->get($client_id);
}

$cartItems = $this->request->getSession()->read('Cart');
$totalPrice = $this->request->getSession()->read('Cart.total_price');
$has_used_coupon = $this->request->getSession()->read('Cart.has_used_coupon');

?>

<body>
    <div class="page-container">
        <h3 class="big-title bold">Checkout</h3>
        <section class="user-info">
            <h4 class="title bold">Riepilogo dati personali</h4>
            <div class="user-info-resume">
                <p class="paragraph"><?= $client->name . " " . $client->surname ?></p>
                <p class="paragraph"><?= $client->email ?></p>
                <p class="paragraph"><?= $client->address ?></p>
                <p class="paragraph"><?= $client->country ?></p>
                <?php if ($client->newsletter) : ?>
                    <p class="paragraph">Desidero iscrivermi alla newsletter</p>
                <?php else : ?>
                    <p class="paragraph">Non desidero iscrivermi alla newsletter</p>
                <?php endif; ?>
                <?php if ($invoice) : ?>
                    <p class="paragraph">Richiedo fattura</p>
                <?php else : ?>
                    <p class="paragraph">Non richiedo fattura</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="cart-items">
            <h4 class="big-title bold">Riepilogo carrello</h4>
            <table class="cart-items">
                <thead>
                    <tr>
                        <th class="tiny-title">Prodotto</th>
                        <th class="tiny-title">Prezzo</th>
                        <th class="tiny-title">Quantità</th>
                        <th class="tiny-title">Totale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $cartItem) : ?>
                        <?php if (is_array($cartItem) && !isset($cartItem['total_price'])) : ?>
                            <tr row-id="<?= $cartItem['id'] ?>">
                                <?php /*
                <td class="cart-action tac">
                  <a href="/cart/deleteFromCart/<?= $cartItem['id'] ?>" class="remove-from-cart" data-product-id="<?= $cartItem['id'] ?>">x</a>
                </td>
                */ ?>
                                <td class="cart-item paragraph"><?= $cartItem['name'] ?></td>
                                <td class="cart-price tar paragraph" data-product-price="<?= $cartItem['id'] ?>"><?= $cartItem['price'] . '€' ?></td>

                                <td class="cart-action cart-quantity tac">
                                    <p paragraph><?= $cartItem['quantity'] ?></p>
                                </td>

                                <td class="row-total tar paragraph" data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'] . '€' ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td class="cart-total tar paragraph" data-cart-total><?= $totalPrice . '€' ?></td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <?= $this->Form->create(null, ['url' => ['controller' => 'Payments', 'action' => 'req']]) ?>

        <?= $this->Form->hidden('client_id', ['value' => $client_id]) ?>
        <?= $this->Form->hidden('invoice', ['value' => $invoice]) ?>
        <?= $this->Form->hidden('order_address', ['value' => $order_address]) ?>

        <section class="payment">
            <div class="payment-type-container">
                <?= $this->Form->radio('payment_type', [
                    ['value' => 'stripe', 'text' => 'Paga con Stripe', 'data-stripe-payment' => '']
                ]) ?>
                <div class="payment-error" data-payment-error></div>
            </div>

            <div class="field field-checkbox">
                <div class="privacy-checkbox-container">
                    <?= $this->Form->checkbox('terms_and_conditions', ['data-privacy-check' => '']) ?>
                    <label class="form-check-label"><a href="<?= $this->Url->build('/terms-and-conditions') ?>">Ho letto e accetto le condizioni generali di vendita</a></label>
                </div>
                <div class="privacy-error" data-privacy-error></div>
            </div>
        </section>

        <section class="form-actions">
            <?= $this->Html->link('Indietro', '/', ['class' => 'button']) ?>
            <?= $this->Form->button('Procedi', ['data-pay-button' => '']) ?>
        </section>
        <?= $this->Form->end() ?>
        </form>
    </div>