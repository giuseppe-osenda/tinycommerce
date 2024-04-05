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
      <h3>Dati utente</h3>
      <form action="<?= $this->Url->build('/checkout'); ?>"> <!-- This form will be submitted to checkout.html, default method is get resulting in a query string -->
        <section class="user-data">
          <div class="field">
            <input type="text" name="first-name" placeholder="Nome" />
          </div>
          <div class="field">
            <input type="text" name="last-name" placeholder="Cognome" />
          </div>
          <div class="field">
            <input type="email" name="email" placeholder="Email" />
          </div>
          <div class="field field-select">
            <select name="nation" placeholder="Nazione">
              <option value="">Nazione</option>
              <option value="Argentina">Argentina</option>
              <option value="Italy">Italy</option>
              <option value="USA">USA</option>
            </select>
          </div>
          <div class="field field-checkbox">
            <label>Iscriviti alla newsletter</label>
            <input type="checkbox" name="newsletter" />
          </div>
          <div class="field field-checkbox">
            <label>Richiedi fattura</label>
            <input type="checkbox" name="invoice" />
          </div>
          <div class="field">
            <input type="text" name="fiscal-tax-number" placeholder="Partita IVA" />
          </div>
          <div class="field">
            <input type="text" name="fiscal-code-number" placeholder="Codice Fiscale" />
          </div>
          <div class="field field-checkbox">
            <label>Ho letto e accetto l'informativa sulla privacy</label>
            <input type="checkbox" name="privacy" />
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
