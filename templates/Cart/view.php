<?php
$total = 0; // inizializzo la variabile prezzo totale
$cartItems = $this->request->getSession()->read('Cart'); // leggo il carrello dalla sessione
$totalPrice = $this->request->getSession()->read('Cart.total_price'); // leggo il prezzo totale dalla sessione
$has_used_coupon = $this->request->getSession()->read('Cart.has_used_coupon'); // leggo se è stato usato un coupon
?>

<section class="page-container">
  <h3>Carrello</h3>
  <section class="cart-items">
    <table class="cart-items">
      <thead>
        <tr>
          <th class="tiny-title"></th>
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
              <td class="cart-action tac">
                <a href="/cart/deleteFromCart/<?= $cartItem['id'] ?>" class="remove-from-cart" data-product-id="<?= $cartItem['id'] ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="M370.001-650.001v-59.998h219.998v59.998H370.001ZM286.154-97.694q-29.153 0-49.576-20.422-20.423-20.423-20.423-49.577 0-29.153 20.423-49.576 20.423-20.423 49.576-20.423 29.154 0 49.577 20.423t20.423 49.576q0 29.154-20.423 49.577-20.423 20.422-49.577 20.422Zm387.692 0q-29.154 0-49.577-20.422-20.423-20.423-20.423-49.577 0-29.153 20.423-49.576 20.423-20.423 49.577-20.423 29.153 0 49.576 20.423 20.423 20.423 20.423 49.576 0 29.154-20.423 49.577-20.423 20.422-49.576 20.422ZM60.001-810v-59.998h114.461l166.923 352.307h272.691q3.462 0 6.155-1.731 2.692-1.731 4.615-4.808l147.923-265.768h68.306l-163.691 295.69q-9.847 17.308-26.039 26.962-16.192 9.653-35.499 9.653H324l-46.308 84.616q-3.077 4.616-.192 10.001t8.654 5.385h457.691v59.998H286.154q-39.999 0-60.422-34.192-20.423-34.192-1.116-69.191l57.078-102.616-145.539-306.308H60.001Z" />
                  </svg>
                </a>
              </td>
              <td class="cart-item title"><?= $cartItem['name'] ?></td>
              <td class="cart-price tar title " data-product-price="<?= $cartItem['id'] ?>"><?= $cartItem['price'].'€' ?></td>

              <td class="cart-action cart-quantity tac">
                <?= $this->Form->hidden('id', ['value' => $cartItem['id']]) ?>
                <?php if ($has_used_coupon) :  ?>
                  <?= $this->Form->select('quantity', range($cartItem['quantity'], $cartItem['quantity']), ['disabled' => 'disabled']) ?>
                <?php else : ?>
                  <?= $this->Form->select('quantity', array_combine(range(1, $cartItem['stock_qty']), range(1, $cartItem['stock_qty'])), ['id' => 'quantity-' . $cartItem['id'], 'default' => $cartItem['quantity']]) ?>
                <?php endif; ?>
              </td>

              <td class="row-total tar title " data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'].'€' ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td class="cart-total tar title bold" data-cart-total><?= $totalPrice.'€' ?></td>
        </tr>
      </tfoot>
    </table>
  </section>

  <?= $this->Form->create(null, ['url' => ['controller' => 'Coupons', 'action' => 'apply'], 'class' => 'coupon-form']) ?>
  <section class="cart-coupon tar">
    <span class="cart-total-label title">Inserisci codice coupon</span>
    <?= $this->Form->control('coupon_code', ['type' => 'text', 'label' => false]) ?>
    <?= $this->Form->button('Applica coupon', ['class' => 'positive right']) ?>
    <p class="coupon-alert alert"></p>
  </section>
  <?= $this->Form->end() ?>

  <section class="tar">
    <a class="button btn right positive" href="<?= $this->Url->build('/user-info'); ?>">Procedi</a> <!-- qui c'era un errore -->
  </section>
</section>