<?php
$total = 0;
$cartItems = $this->request->getSession()->read('Cart');
$totalPrice = $this->request->getSession()->read('Cart.total_price');
?>

<section class="page-container">
  <h3>Carrello</h3>
  <section class="cart-items">
    <table class="cart-items">
      <thead>
        <tr>
          <th></th>
          <th>Prodotto</th>
          <th>Prezzo</th>
          <th>Quantità</th>
          <th>Totale</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cartItems as $cartItem) : ?>
          <?php if (is_array($cartItem) && !isset($cartItem['total_price'])) : ?>
            <tr row-id="<?= $cartItem['id'] ?>">
              <td class="cart-action tac">
                <a href="/cart/deleteFromCart/<?= $cartItem['id'] ?>" class="remove-from-cart" data-product-id="<?= $cartItem['id'] ?>">x</a>
              </td>
              <td class="cart-item"><?= $cartItem['name'] ?></td>
              <td class="cart-price tar"><?= $cartItem['price'] ?></td>

              <td class="cart-action cart-quantity tac">
                <?= $this->Form->hidden('id', ['value' => $cartItem['id']]) ?>
                <?= $this->Form->select('quantity', array_combine(range(1, $cartItem['stock_qty']), range(1, $cartItem['stock_qty'])), ['id' => 'quantity-' . $cartItem['id'], 'default' => $cartItem['quantity']]) ?>
              </td>

              <td class="row-total tar" data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'] ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td class="cart-total tar" data-cart-total><?= $totalPrice ?></td>
        </tr>
      </tfoot>
    </table>
  </section>

  <?= $this->Form->create(null, ['url' => ['controller' => 'Coupons', 'action' => 'apply'], 'class' => 'coupon-form']) ?>
  <section class="cart-coupon tar">
    <span class="cart-total-label">Inserisci codice coupon:</span>
    <?= $this->Form->control('coupon_code', ['type' => 'text', 'label' => false]) ?>
    <?php /*foreach ($cartItems as $cartItem) : ?>
      <?php if (is_array($cartItem) && !isset($cartItem['total_price'])) : ?>
        <?= $this->Form->hidden('product_ids[]', ['value' => $cartItem['id']]) ?>
      <?php endif; ?>
    <?php endforeach; */?>
    <?= $this->Form->button('Applica coupon') ?>
  </section>
  <?= $this->Form->end() ?>

  <section class="tar">
    <a class="button" href="<?= $this->Url->build('/user-info'); ?>">Procedi</a> <!-- qui c'era un errore -->
  </section>
</section>