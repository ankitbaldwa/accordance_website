<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $mailBody
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mailBody->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mailBody->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Mail Bodies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mailBodies form content">
            <?= $this->Form->create($mailBody) ?>
            <fieldset>
                <legend><?= __('Edit Mail Body') ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('subject');
                    echo $this->Form->control('body');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
