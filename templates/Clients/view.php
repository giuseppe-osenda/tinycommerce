    <?php //debug($cart); 
    ?>
    <div class="page-container">
        <h3>Dati utente</h3>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Clients', 'action' => 'req'], 'class' => 'client-form']) ?>
        <section class="user-data">
            <?= $this->Form->control('name', ['placeholder' => 'Nome', 'label' => 'Nome*']) ?>
            <?= $this->Form->control('surname', ['placeholder' => 'Cognome', 'label' => 'Cognome*']) ?>
            <?= $this->Form->control('email', ['placeholder' => 'Email', 'label' => 'Email*']) ?>
            <?= $this->Form->control('address', ['placeholder' => 'Indirizzo', 'label' => 'Indirizzo*']) ?>
            <?= $this->Form->select('country', ['' => 'Nazione*', 'Argentina' => 'Argentina', 'Italy' => 'Italy', 'USA' => 'USA'], ['placeholder' => 'Nazione']) ?>
            <?= $this->Form->control('newsletter', ['type' => 'checkbox', 'label'=>'Iscriviti alla newsletter']); ?>
            <?= $this->Form->control('invoice', ['type' => 'checkbox', 'label'=>'Richiedi fattura']); ?>
            <?= $this->Form->control('vat_number', ['placeholder' => 'Partita Iva', 'label' => 'Partita Iva']) ?>
            <?= $this->Form->control('tax_code', ['placeholder' => 'Codice Fiscale', 'label' => 'Codice Fiscale']) ?>
            <?= $this->Form->control('privacy', ['type' => 'checkbox', 'label'=>"Ho letto e accetto l'informativa sulla privacy"]); ?>
        </section>

        <section>
            <?= $this->Html->link('Indietro', '/', ['class' => 'button']) ?>
            <?= $this->Form->button('Procedi') ?>
        </section>
        <?= $this->Form->end() ?>
        <p class="client-alert"></p>
    </div>