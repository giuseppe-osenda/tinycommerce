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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $coupon->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $coupon->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Coupons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="coupons form content">
            <?= $this->Form->create($coupon) ?>
            <fieldset>
                <legend><?= __('Edit Coupon') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('min_price');
                    echo $this->Form->control('max_price');
                    echo $this->Form->control('discount');
                    echo $this->Form->control('active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
