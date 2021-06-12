<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $releaseNote
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Release Note'), ['action' => 'edit', $releaseNote->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Release Note'), ['action' => 'delete', $releaseNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $releaseNote->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Release Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Release Note'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="releaseNotes view content">
            <h3><?= h($releaseNote->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Release Notes') ?></th>
                    <td><?= h($releaseNote->release_notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Release Notes Pdf') ?></th>
                    <td><?= h($releaseNote->release_notes_pdf) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($releaseNote->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($releaseNote->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Version') ?></th>
                    <td><?= $this->Number->format($releaseNote->version) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Id') ?></th>
                    <td><?= $this->Number->format($releaseNote->package_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($releaseNote->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($releaseNote->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Key Points') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($releaseNote->key_points)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
