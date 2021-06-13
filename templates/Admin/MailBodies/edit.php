<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $mailBody
 */
?>
<?= $this->Form->create($mailBody, ['id'=> 'mailbodies-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Type </label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('type', ['type'=> 'text','label'=>false, 'class' => 'form-control', 'placeholder'=>'Select Country Name', 'readonly'=> true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Subject *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('subject', ['type'=> 'text','label'=>false, 'class' => 'form-control', 'placeholder'=>'Subject', 'required'=> false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Mail Body *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('body', ['class' => 'form-control', 'placeholder'=>'Mail Body', 'autocomplete'=>'off', 'label'=> false, 'required'=> false]) ?>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_city_submit']); ?> 
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
<!-- <div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mailBody->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mailBody->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Mail Bodies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mailBodies form content">
            <?= $this->Form->create($mailBody) ?>
            <fieldset>
                <legend><?= __('Edit Mail Body') ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('subject');
                    echo $this->Form->control('body');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
