<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $releaseNotes
 */
?>
<div class="releaseNotes index content">
    <?= $this->Html->link(__('New Release Note'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Release Notes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('version') ?></th>
                    <th><?= $this->Paginator->sort('package_id') ?></th>
                    <th><?= $this->Paginator->sort('release_notes') ?></th>
                    <th><?= $this->Paginator->sort('release_notes_pdf') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($releaseNotes as $releaseNote): ?>
                <tr>
                    <td><?= $this->Number->format($releaseNote->id) ?></td>
                    <td><?= $this->Number->format($releaseNote->version) ?></td>
                    <td><?= $this->Number->format($releaseNote->package_id) ?></td>
                    <td><?= h($releaseNote->release_notes) ?></td>
                    <td><?= h($releaseNote->release_notes_pdf) ?></td>
                    <td><?= h($releaseNote->status) ?></td>
                    <td><?= h($releaseNote->created) ?></td>
                    <td><?= h($releaseNote->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $releaseNote->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $releaseNote->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $releaseNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $releaseNote->id)]) ?>
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
