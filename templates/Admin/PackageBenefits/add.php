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
            <?= $this->Html->link(__('List Package Benefits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packageBenefits form content">
            <?= $this->Form->create($packageBenefit) ?>
            <fieldset>
                <legend><?= __('Add Package Benefit') ?></legend>
                <?php
                    echo $this->Form->control('package_id');
                    echo $this->Form->control('title');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
