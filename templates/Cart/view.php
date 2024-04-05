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
        <tr>
          <td class="cart-action tac">
            <span>x</span>
          </td>
          <td class="cart-item">Prodotto 1</td>
          <td class="cart-price tar">12</td>
          <td class="cart-action cart-quantity tac">
            <span class="cart-quantity-minus">-</span>
            <span class="cart-quantity-value">3</span>
            <span class="cart-quantity-plus">+</span>
          </td>
          <td class="row-total tar">36</td>
        </tr>
        <tr>
          <td class="cart-action tac">
            <span>x</span>
          </td>
          <td class="cart-item">Prodotto 2</td>
          <td class="cart-price tar">4</td>
          <td class="cart-action cart-quantity tac">
            <span class="cart-quantity-minus">-</span>
            <span class="cart-quantity-value">2</span>
            <span class="cart-quantity-plus">+</span>
          </td>
          <td class="row-total tar">8</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td class="cart-total tar">44</td>
        </tr>
      </tfoot>
    </table>
  </section>

  <section class="cart-coupon tar">
    <span class="cart-total-label">Inserisci codice coupon:</span>
    <input type="text" name="coupon-code" />
    <button>Applica coupon</button>
  </section>

  <section class="tar">
    <a class="button" href="<?= $this->Url->build('/user-info'); ?>">Procedi</a> <!-- qui c'era un errore -->
  </section>
</section>