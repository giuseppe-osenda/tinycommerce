<?php
$total = 0; // inizializzo la variabile prezzo totale
$cartItems = $this->request->getSession()->read('Cart'); // leggo il carrello dalla sessione
$totalPrice = $this->request->getSession()->read('Cart.total_price'); // leggo il prezzo totale dalla sessione
$has_used_coupon = $this->request->getSession()->read('Cart.has_used_coupon'); // leggo se è stato usato un coupon
$original_prices = $this->request->getSession()->read('original_prices'); // leggo i prezzi originali dalla sessione
$original_total = $this->request->getSession()->read('original_total'); // leggo il prezzo totale originale dalla sessione
$coupon_code = $this->request->getSession()->read('Cart.coupon_code'); // leggo il codice coupon dalla sessione
?>

<section class="page-container">
  <h3 class="big-title bold">Carrello</h3>
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
          <?php if (is_array($cartItem)) : ?>
            <tr row-id="<?= $cartItem['id'] ?>">
              <td class="cart-action tac">
                <a href="/cart/deleteFromCart/<?= $cartItem['id'] ?>" class="remove-from-cart" data-product-id="<?= $cartItem['id'] ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                  </svg>
                </a>
              </td>
              <td class="cart-item paragraph"><?= $cartItem['name'] ?></td>
              <td class="cart-price tar paragraph " data-product-price="<?= $cartItem['id'] ?>">
                <del data-del-price><?php echo $original_prices[$cartItem['id']] . '€' ?></del>
                <?php if ($has_used_coupon && $original_prices[$cartItem['id']] > $cartItem['price']) : ?>
                  <del><?php echo $original_prices[$cartItem['id']] . '€' ?></del>
                <?php endif; ?>
                <span data-original-price><?= $cartItem['price'] . '€' ?></span>
              </td>

              <td class="cart-action cart-quantity tac">
                <?= $this->Form->hidden('id', ['value' => $cartItem['id']]) ?>
                <?php if ($has_used_coupon) :  ?>
                  <?= $this->Form->select('quantity', range($cartItem['quantity'], $cartItem['quantity']), ['disabled' => 'disabled']) ?>
                <?php else : ?>
                  <?= $this->Form->select('quantity', array_combine(range(1, $cartItem['stock_qty']), range(1, $cartItem['stock_qty'])), ['id' => 'quantity-' . $cartItem['id'], 'class' => 'select-product-quantity', 'default' => $cartItem['quantity']]) ?>
                <?php endif; ?>
              </td>

              <td class="row-total tar paragraph " data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'] . '€' ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td class="cart-total tar paragraph bold" data-cart-total>

            <div class="cart-total-prices">
              <del data-del-total><?php echo $original_total . '€' ?></del>

              <?php if ($has_used_coupon) : ?>
                <del><?php echo $original_total . '€' ?></del>
              <?php endif; ?>

              <span data-original-total><?= $totalPrice . '€' ?></span>
            </div>
            <span data-coupon-code></span>

            <?php if ($has_used_coupon) : ?>
              <span data-coupon-code><?= $coupon_code ?></span>
            <?php endif; ?>
          </td>
        </tr>
      </tfoot>
    </table>
  </section>

  <?= $this->Form->create(null, ['url' => ['controller' => 'Coupons', 'action' => 'apply'], 'class' => 'coupon-form']) ?>
  <section class="cart-coupon tar">
    <span class="cart-total-label paragraph">Inserisci codice coupon</span>
    <?= $this->Form->control('coupon_code', ['type' => 'text', 'label' => false, 'class' => 'coupon-text-field']) ?>
    <?= $this->Form->button('Applica coupon', ['class' => 'positive right']) ?>
    <p class="coupon-alert alert"></p>
  </section>
  <?= $this->Form->end() ?>

  <section class="tar">
    <a class="button btn right positive" href="<?= $this->Url->build('/user-info'); ?>">Procedi</a> <!-- qui c'era un errore -->
  </section>
</section>