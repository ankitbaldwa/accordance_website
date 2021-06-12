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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mstCity->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mstCity->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Mst Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mstCities form content">
            <?= $this->Form->create($mstCity) ?>
            <fieldset>
                <legend><?= __('Edit Mst City') ?></legend>
                <?php
                    echo $this->Form->control('mst_country_id', ['options' => $mstCountries]);
                    echo $this->Form->control('mst_state_id', ['options' => $mstStates]);
                    echo $this->Form->control('city_name');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
