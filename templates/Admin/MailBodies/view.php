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
            <?= $this->Html->link(__('Edit Mail Body'), ['action' => 'edit', $mailBody->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mail Body'), ['action' => 'delete', $mailBody->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mailBody->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Mail Bodies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mail Body'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mailBodies view content">
            <h3><?= h($mailBody->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($mailBody->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($mailBody->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mailBody->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($mailBody->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($mailBody->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($mailBody->body)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
