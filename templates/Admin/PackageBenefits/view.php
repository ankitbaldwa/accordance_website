<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $packageBenefit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Package Benefit'), ['action' => 'edit', $packageBenefit->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package Benefit'), ['action' => 'delete', $packageBenefit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageBenefit->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Package Benefits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package Benefit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packageBenefits view content">
            <h3><?= h($packageBenefit->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($packageBenefit->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($packageBenefit->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Id') ?></th>
                    <td><?= $this->Number->format($packageBenefit->package_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($packageBenefit->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($packageBenefit->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
