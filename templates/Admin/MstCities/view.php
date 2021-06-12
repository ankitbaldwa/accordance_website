<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MstCity $mstCity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Mst City'), ['action' => 'edit', $mstCity->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mst City'), ['action' => 'delete', $mstCity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mstCity->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Mst Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mst City'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mstCities view content">
            <h3><?= h($mstCity->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Mst Country') ?></th>
                    <td><?= $mstCity->has('mst_country') ? $this->Html->link($mstCity->mst_country->id, ['controller' => 'MstCountries', 'action' => 'view', $mstCity->mst_country->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Mst State') ?></th>
                    <td><?= $mstCity->has('mst_state') ? $this->Html->link($mstCity->mst_state->id, ['controller' => 'MstStates', 'action' => 'view', $mstCity->mst_state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('City Name') ?></th>
                    <td><?= h($mstCity->city_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($mstCity->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mstCity->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($mstCity->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($mstCity->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
