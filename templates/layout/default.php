<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$description = 'TinyCommerce';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> <!-- TODO: qui c'era un errore, content deve essere dichiarato una volta sola !-->
    <title>
        <?= $description ?>
    </title>


    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'application']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>

    <header></header>
    <main class="main">
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>


    <?= $this->Html->scriptBlock(sprintf( //aggiungo il token CSRF alla pagina per autenticare le richieste AJAX
        'var csrfToken = %s;',
        json_encode($this->request->getAttribute('csrfToken'))
    )); ?>

    
    <?= $this->Html->script(['jquery.min.js', 'custom.js']) ?>
    <?= $this->fetch('scriptBottom') ?>
</body>

</html>