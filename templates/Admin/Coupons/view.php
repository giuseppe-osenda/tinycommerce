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
            <?= $this->Html->link(__('Edit Coupon'), ['action' => 'edit', $coupon->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Coupon'), ['action' => 'delete', $coupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coupon->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Coupons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Coupon'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="coupons view content">
            <h3><?= h($coupon->code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($coupon->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= h($coupon->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($coupon->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Min Price') ?></th>
                    <td><?= $this->Number->format($coupon->min_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Price') ?></th>
                    <td><?= $coupon->max_price === null ? '' : $this->Number->format($coupon->max_price) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Associated Product Ids') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($coupon->associated_product_ids)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
