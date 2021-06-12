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
            <?= $this->Html->link(__('List Release Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="releaseNotes form content">
            <?= $this->Form->create($releaseNote) ?>
            <fieldset>
                <legend><?= __('Add Release Note') ?></legend>
                <?php
                    echo $this->Form->control('version');
                    echo $this->Form->control('package_id');
                    echo $this->Form->control('release_notes');
                    echo $this->Form->control('release_notes_pdf');
                    echo $this->Form->control('key_points');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
