<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MstState $mstState
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Mst State'), ['action' => 'edit', $mstState->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mst State'), ['action' => 'delete', $mstState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mstState->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Mst States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mst State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mstStates view content">
            <h3><?= h($mstState->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Mst Country') ?></th>
                    <td><?= $mstState->has('mst_country') ? $this->Html->link($mstState->mst_country->id, ['controller' => 'MstCountries', 'action' => 'view', $mstState->mst_country->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State Name') ?></th>
                    <td><?= h($mstState->state_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($mstState->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mstState->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($mstState->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($mstState->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Mst Cities') ?></h4>
                <?php if (!empty($mstState->mst_cities)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Mst Country Id') ?></th>
                            <th><?= __('Mst State Id') ?></th>
                            <th><?= __('City Name') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($mstState->mst_cities as $mstCities) : ?>
                        <tr>
                            <td><?= h($mstCities->id) ?></td>
                            <td><?= h($mstCities->mst_country_id) ?></td>
                            <td><?= h($mstCities->mst_state_id) ?></td>
                            <td><?= h($mstCities->city_name) ?></td>
                            <td><?= h($mstCities->status) ?></td>
                            <td><?= h($mstCities->created) ?></td>
                            <td><?= h($mstCities->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'MstCities', 'action' => 'view', $mstCities->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'MstCities', 'action' => 'edit', $mstCities->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'MstCities', 'action' => 'delete', $mstCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mstCities->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
