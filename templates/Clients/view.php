    <?php //debug($cart); 
    ?>
    <div class="page-container client-form-container">
        <h3 class="big-title bold">Dati utente</h3>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Clients', 'action' => 'req'], 'class' => 'client-form']) ?>
        <section class="user-data">
            <div class="user-data-title">
                <p class="title semibold">Anagrafica</p>
                <p class="user-data-paragraph paragraph">I campi contrassegnati con * sono obbligatori, se hai già effettuato un ordine utilizza lo stesso indirizzo mail</p>
            </div>
            <div class="user-data-fields">
                <?= $this->Form->control('name', ['placeholder' => 'Nome', 'label' => 'Nome*']) ?>
                <?= $this->Form->control('surname', ['placeholder' => 'Cognome', 'label' => 'Cognome*']) ?>
                <?= $this->Form->control('email', ['placeholder' => 'Email', 'label' => 'Email*']) ?>
                <?= $this->Form->control('address', ['placeholder' => 'Indirizzo', 'label' => 'Indirizzo*']) ?>
                <?= $this->Form->label('Nazione*'); ?>
                <?= $this->Form->select('country', ['Argentina' => 'Argentina', 'Italy' => 'Italy', 'USA' => 'USA'], ['placeholder' => 'Nazione', 'empty' => 'Seleziona']) ?>

            </div>
        </section>
        <section class="user-data">
            <div class="user-data-title">
                <p class="title semibold">Preferenze</p>
                <p class="user-data-paragraph paragraph">I campi contrassegnati con * sono obbligatori, se richiedi la fattura ricordati di inserire la partita iva e/o il codice fiscale!</p>
            </div>
            <div class="user-data-fields">
                <?= $this->Form->control('vat_number', ['placeholder' => 'Partita Iva', 'label' => 'Partita Iva']) ?>
                <?= $this->Form->control('tax_code', ['placeholder' => 'Codice Fiscale', 'label' => 'Codice Fiscale']) ?>
                <div class="user-data-preferences">
                    <?= $this->Form->control('newsletter', ['type' => 'checkbox', 'label' => 'Iscriviti alla newsletter']); ?>
                    <?= $this->Form->control('invoice', ['type' => 'checkbox', 'label' => 'Richiedi fattura']); ?>
                    <?= $this->Form->control('privacy', ['type' => 'checkbox', 'label' => "Ho letto e accetto l'informativa sulla privacy*"]); ?>
                </div>
            </div>
            <p class="client-alert error"></p>

        </section>

        <section class="form-actions right">
            <?= $this->Html->link('Indietro', '/', ['class' => 'button-secondary']) ?>
            <?= $this->Form->button('Procedi') ?>
        </section>

        <?= $this->Form->end() ?>
    </div>