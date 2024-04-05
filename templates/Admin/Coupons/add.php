<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coupon $coupon
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Coupons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="coupons form content">
            <?= $this->Form->create($coupon) ?>
            <fieldset>
                <legend><?= __('Add Coupon') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('active');
                    echo $this->Form->control('min_price');
                    echo $this->Form->control('max_price');
                    echo $this->Form->control('associated_product_ids');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
