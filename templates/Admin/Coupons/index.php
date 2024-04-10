<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Coupon> $coupons
 */
?>
<div class="coupons index content">
    <?= $this->Html->link(__('New Coupon'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Coupons') ?></h3>
    <div class="table-responsive">
        <table class="table m-0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('min_price') ?></th>
                    <th><?= $this->Paginator->sort('max_price') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td><?= $this->Number->format($coupon->id) ?></td>
                    <td><?= h($coupon->code) ?></td>
                    <td><?= h($coupon->active) ?></td>
                    <td><?= $this->Number->format($coupon->min_price) ?></td>
                    <td><?= $coupon->max_price === null ? '' : $this->Number->format($coupon->max_price) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $coupon->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coupon->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coupon->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
