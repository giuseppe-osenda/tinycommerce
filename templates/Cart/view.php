<?php
$total = 0; // inizializzo la variabile prezzo totale
$cartItems = $this->request->getSession()->read('Cart'); // leggo il carrello dalla sessione
$totalPrice = $this->request->getSession()->read('Cart.total_price'); // leggo il prezzo totale dalla sessione
$has_used_coupon = $this->request->getSession()->read('Cart.has_used_coupon'); // leggo se è stato usato un coupon
$original_prices = $this->request->getSession()->read('original_prices'); // leggo i prezzi originali dalla sessione per gesire lato frontend il barramento
$original_total = $this->request->getSession()->read('original_total'); // leggo il prezzo totale originale dalla sessione per gesire lato frontend il barramento
$coupon_code = $this->request->getSession()->read('Cart.coupon_code'); // leggo il codice coupon dalla sessione per gesire lato frontend il barramento
$coupon_id = $this->request->getSession()->read('Cart.coupon_id'); // leggo l'id del coupon dalla sessione

$at_least_one_product = false; // flag per verificare se almeno un prodotto ha il coupon applicato
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
            <?php if (isset($coupon_id)) {
              if ($cartItem['coupon_id'] == $coupon_id) {
                $at_least_one_product = true;
              }
            } ?>
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
                <del data-del-price><?php echo $original_prices[$cartItem['id']] . '€' ?></del> <!--inizialmente nascosto viene mostrato solo se è stato usato un coupon -->
                <?php if ($has_used_coupon && $original_prices[$cartItem['id']] > $cartItem['price']) : ?> <!-- per gestire il barramento del prezzo dopo il reload della pagina -->
                  <del><?php echo $original_prices[$cartItem['id']] . '€' ?></del>
                <?php endif; ?>
                <span data-original-price><?= $cartItem['price'] . '€' ?></span> <!-- il prezzo aggiornato, da mostrare sempre -->
              </td>

              <td class="cart-action cart-quantity tac">
                <?= $this->Form->hidden('id', ['value' => $cartItem['id']]) ?> <!-- passo l'id del prodotto per gestire l'aggiornamento delle quantità -->
                <?php if ($has_used_coupon) :  ?> <!-- se è stato usato un coupon, disabilito il campo select -->
                  <?= $this->Form->select('quantity', range($cartItem['quantity'], $cartItem['quantity']), ['disabled' => 'disabled']) ?>
                <?php else : ?>
                  <?= $this->Form->select('quantity', array_combine(range(1, $cartItem['stock_qty']), range(1, $cartItem['stock_qty'])), ['id' => 'quantity-' . $cartItem['id'], 'class' => 'select-product-quantity', 'default' => $cartItem['quantity']]) ?>
                <?php endif; ?>
              </td>

              <td class="row-total tar paragraph " data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'] . '€' ?></td> <!-- prezzo totale per il singolo prodotto -->
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td class="cart-total tar paragraph bold">

            <div class="cart-total-prices" data-cart-total>
              <del data-del-total><?php echo $original_total . '€' ?></del> <!--inizialmente nascosto viene mostrato solo se è stato usato un coupon -->

              <?php if ($has_used_coupon && $at_least_one_product) : ?> <!-- per gestire il barramento del prezzo dopo il reload della pagina -->
                <del data-session-del-total><?php echo $original_total . '€' ?></del>
              <?php endif; ?>

              <span data-original-total><?= $totalPrice . '€' ?></span> <!-- il prezzo aggiornato, da mostrare sempre -->
            </div>
            <span data-coupon-code></span> <!-- il nome del coupon utilizzato inizialmente nascosto -->

            <?php if ($has_used_coupon && $at_least_one_product) : ?> <!-- sper mostrare il nome del coupon utilizzato dopo il reload della pagina-->
              <span data-coupon-code><?= $coupon_code ?></span>
            <?php endif; ?>
          </td>
        </tr>
      </tfoot>
    </table>
  </section>

  <?= $this->Form->create(null, ['url' => ['controller' => 'Coupons', 'action' => 'apply'], 'class' => 'coupon-form']) ?> <!-- form per applicare il coupon -->
  <section class="cart-coupon tar">
    <span class="cart-total-label paragraph">Inserisci codice coupon</span>
    <?= $this->Form->control('coupon_code', ['type' => 'text', 'label' => false, 'class' => 'coupon-text-field']) ?> <!-- campo per inserire il coupon -->
    <?= $this->Form->button('Applica coupon', ['class' => 'positive right']) ?> <!-- bottone per applicare il coupon -->
    <p class="coupon-alert alert"></p> <!-- messaggio di errore -->
  </section>
  <?= $this->Form->end() ?>

  <section class="tar">
    <?php if (empty($cartItems)) : ?>
      <a data-cart-proceed class="button btn right positive" href="<?= $this->Url->build('/'); ?>">Procedi</a> <!-- qui c'era un errore html -->
    <?php else : ?>
      <a class="button btn right positive" href="<?= $this->Url->build('/user-info'); ?>">Procedi</a> <!-- qui c'era un errore html -->
    <?php endif; ?>
  </section>
</section>