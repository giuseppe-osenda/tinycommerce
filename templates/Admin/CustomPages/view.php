<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomPage $customPage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Custom Page'), ['action' => 'edit', $customPage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Custom Page'), ['action' => 'delete', $customPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Custom Pages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Custom Page'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="customPages view content">
            <h3><?= h($customPage->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($customPage->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('String 1') ?></th>
                    <td><?= h($customPage->string_1) ?></td>
                </tr>
                <tr>
                    <th><?= __('String 2') ?></th>
                    <td><?= h($customPage->string_2) ?></td>
                </tr>
                <tr>
                    <th><?= __('String 3') ?></th>
                    <td><?= h($customPage->string_3) ?></td>
                </tr>
                <tr>
                    <th><?= __('String 4') ?></th>
                    <td><?= h($customPage->string_4) ?></td>
                </tr>
                <tr>
                    <th><?= __('String 5') ?></th>
                    <td><?= h($customPage->string_5) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customPage->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Text 1') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customPage->text_1)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Text 2') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customPage->text_2)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Text 3') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customPage->text_3)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Text 4') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customPage->text_4)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Text 5') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customPage->text_5)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
