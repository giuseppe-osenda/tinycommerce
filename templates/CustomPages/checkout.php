<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="/assets/css/application.css" />
  </head>

  <body>
    <div class="page-container">
      <h3>Checkout</h3>
      <section class="user-info">
        <h4>Riepilogo dati personali</h4>
        <div>
            Andrea Rossi<br/>
            andrea.rossi@email.com<br/>
            Italia<br/><br/>
            Desidero iscrivermi alla newsletter<br/>
            Non richiedo fattura
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
            <tr>
              <td>Prodotto 1</td>
              <td class="tar">12</td>
              <td class="tac">
                <span>3</span>
              </td>
              <td class="tar">36</td>
            </tr>
            <tr>
              <td>Prodotto 2</td>
              <td class="tar">4</td>
              <td class="tac">
                <span>2</span>
              </td>
              <td class="tar">8</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td class="tar">44</td>
            </tr>
          </tfoot>
        </table>
      </section>
      <form>
        <section class="payment">
          <div class="field">
            <input type="radio" name="payment_type" value="paypal">
            <label>Paga con Paypal</label><br/>
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
  </body>
</html>