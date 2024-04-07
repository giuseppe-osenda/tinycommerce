  <?php

  use Cake\Datasource\FactoryLocator;

  $client_id = $this->request->getQuery('client_id');

  $client = null;
  if (!empty($client_id)) {
    $client = FactoryLocator::get('Table')->get('Clients')->get($client_id);
  }

  $order = null;
  if (!empty($client)) {
    $order = FactoryLocator::get('Table')->get('Orders')->find()->where(['client_id' => $client_id])->all();
  }

  $cartItems = $this->request->getSession()->read('Cart');
  $totalPrice = $this->request->getSession()->read('Cart.total_price');
  $has_used_coupon = $this->request->getSession()->read('Cart.has_used_coupon');

  ?>

  <body>
    <div class="page-container">
      <h3>Checkout</h3>
      <section class="user-info">
        <h4>Riepilogo dati personali</h4>
        <div>
          <p><?= $client->name ?></p>
          <p><?= $client->email ?></p>
          <p><?= $client->country ?></p>
          <?php if ($client->newsletter) : ?>
            <p>Desidero iscrivermi alla newsletter</p>
          <?php else : ?>
            <p>Non desidero iscrivermi alla newsletter</p>
          <?php endif; ?>
          <?php if ($client->invoice) : ?>
            <p>Richiedo fattura</p>
          <?php else : ?>
            <p>Non richiedo fattura</p>
          <?php endif; ?>
        </div>
      </section>

      <section class="cart-items">
        <h4>Riepilogo carrello</h4>
        <table class="cart-items">
          <thead>
            <tr>
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
                  <?php /*
                  <td class="cart-action tac">
                    <a href="/cart/deleteFromCart/<?= $cartItem['id'] ?>" class="remove-from-cart" data-product-id="<?= $cartItem['id'] ?>">x</a>
                  </td>
                  */ ?>
                  <td class="cart-item"><?= $cartItem['name'] ?></td>
                  <td class="cart-price tar" data-product-price="<?= $cartItem['id'] ?>"><?= $cartItem['price'] ?></td>

                  <td class="cart-action cart-quantity tac">
                    <p><?= $cartItem['quantity'] ?></p>
                  </td>
                      
                  <td class="row-total tar" data-row-total=<?= $cartItem['id'] ?>><?= $cartItem['row_total'] ?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>

          <tfoot>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td class="cart-total tar" data-cart-total><?= $totalPrice ?></td>
            </tr>
          </tfoot>
        </table>
      </section>
      <form>
        <section class="payment">
          <div class="field">
            <input type="radio" name="payment_type" value="paypal">
            <label>Paga con Paypal</label><br />
            <input type="radio" name="payment_type" value="stripe">
            <label>Paga con Stripe</label>
          </div>

          <div class="field field-checkbox">
            <label>Ho letto e accetto le condizioni generali di vendita</label>
            <input type="checkbox" name="terms_and_conditions" />
          </div>

        </section>

        <section>
          <a class="button" href="<?= $this->Url->build("/") ?>">Indietro</a>
          <button>Procedi</button>
        </section>
      </form>
    </div>