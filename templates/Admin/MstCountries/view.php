<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $mstCountry
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Mst Country'), ['action' => 'edit', $mstCountry->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mst Country'), ['action' => 'delete', $mstCountry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mstCountry->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Mst Countries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mst Country'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mstCountries view content">
            <h3><?= h($mstCountry->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Country Name') ?></th>
                    <td><?= h($mstCountry->country_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($mstCountry->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($mstCountry->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mstCountry->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($mstCountry->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($mstCountry->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
