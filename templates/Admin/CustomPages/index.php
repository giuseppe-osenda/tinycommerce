<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CustomPage> $customPages
 */
?>
<div class="customPages index content">
    <?= $this->Html->link(__('New Custom Page'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Custom Pages') ?></h3>
    <div class="table-responsive">
        <table class="table m-0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('string_1') ?></th>
                    <th><?= $this->Paginator->sort('string_2') ?></th>
                    <th><?= $this->Paginator->sort('string_3') ?></th>
                    <th><?= $this->Paginator->sort('string_4') ?></th>
                    <th><?= $this->Paginator->sort('string_5') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customPages as $customPage): ?>
                <tr>
                    <td><?= $this->Number->format($customPage->id) ?></td>
                    <td><?= h($customPage->title) ?></td>
                    <td><?= h($customPage->string_1) ?></td>
                    <td><?= h($customPage->string_2) ?></td>
                    <td><?= h($customPage->string_3) ?></td>
                    <td><?= h($customPage->string_4) ?></td>
                    <td><?= h($customPage->string_5) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customPage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customPage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id)]) ?>
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
