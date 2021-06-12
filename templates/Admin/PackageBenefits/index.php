<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $packageBenefits
 */
?>
<div class="packageBenefits index content">
    <?= $this->Html->link(__('New Package Benefit'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Package Benefits') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('package_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packageBenefits as $packageBenefit): ?>
                <tr>
                    <td><?= $this->Number->format($packageBenefit->id) ?></td>
                    <td><?= $this->Number->format($packageBenefit->package_id) ?></td>
                    <td><?= h($packageBenefit->title) ?></td>
                    <td><?= h($packageBenefit->created) ?></td>
                    <td><?= h($packageBenefit->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $packageBenefit->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $packageBenefit->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $packageBenefit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageBenefit->id)]) ?>
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
