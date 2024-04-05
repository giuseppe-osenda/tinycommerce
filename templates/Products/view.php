<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="products view content">
            <h3><?= h($product->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= h($product->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($product->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($product->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Qty') ?></th>
                    <td><?= $this->Number->format($product->stock_qty) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Name') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->name)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Order Products') ?></h4>
                <?php if (!empty($product->order_products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->order_products as $orderProducts) : ?>
                        <tr>
                            <td><?= h($orderProducts->id) ?></td>
                            <td><?= h($orderProducts->order_id) ?></td>
                            <td><?= h($orderProducts->product_id) ?></td>
                            <td><?= h($orderProducts->qty) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderProducts', 'action' => 'view', $orderProducts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderProducts', 'action' => 'edit', $orderProducts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderProducts', 'action' => 'delete', $orderProducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderProducts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
