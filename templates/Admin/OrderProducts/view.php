<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderProduct $orderProduct
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Product'), ['action' => 'edit', $orderProduct->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Product'), ['action' => 'delete', $orderProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderProduct->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderProducts view content">
            <h3><?= h($orderProduct->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderProduct->hasValue('order') ? $this->Html->link($orderProduct->order->complete, ['controller' => 'Orders', 'action' => 'view', $orderProduct->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $orderProduct->hasValue('product') ? $this->Html->link($orderProduct->product->name, ['controller' => 'Products', 'action' => 'view', $orderProduct->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderProduct->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($orderProduct->qty) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
