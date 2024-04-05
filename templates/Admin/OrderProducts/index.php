<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderProduct> $orderProducts
 */
?>
<div class="orderProducts index content">
    <?= $this->Html->link(__('New Order Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderProducts as $orderProduct): ?>
                <tr>
                    <td><?= $this->Number->format($orderProduct->id) ?></td>
                    <td><?= $orderProduct->hasValue('order') ? $this->Html->link($orderProduct->order->complete, ['controller' => 'Orders', 'action' => 'view', $orderProduct->order->id]) : '' ?></td>
                    <td><?= $orderProduct->hasValue('product') ? $this->Html->link($orderProduct->product->name, ['controller' => 'Products', 'action' => 'view', $orderProduct->product->id]) : '' ?></td>
                    <td><?= $this->Number->format($orderProduct->qty) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderProduct->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderProduct->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderProduct->id)]) ?>
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
