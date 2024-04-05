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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customPage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Custom Pages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="customPages form content">
            <?= $this->Form->create($customPage) ?>
            <fieldset>
                <legend><?= __('Edit Custom Page') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('text_1');
                    echo $this->Form->control('text_2');
                    echo $this->Form->control('text_3');
                    echo $this->Form->control('text_4');
                    echo $this->Form->control('text_5');
                    echo $this->Form->control('string_1');
                    echo $this->Form->control('string_2');
                    echo $this->Form->control('string_3');
                    echo $this->Form->control('string_4');
                    echo $this->Form->control('string_5');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
