<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $packageBenefit
 */
?>
<?= $this->Form->create($packageBenefit, ['enctype' => 'multipart/form-data', 'id'=> 'package-benefits-form', 'novalidate'=>"novalidate"]) ?>
<?= $this->Form->hidden('package_id',['value'=>$id, 'escape' => false, 'label' => false]); ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Title *</label>
    <div class="col-lg-6 col-md-9 col-sm-12">
        <?= $this->Form->control('title', ['class' => 'form-control', 'placeholder'=>'Title', 'autocomplete'=>'off', 'escape' => false, 'label' => false]) ?>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit ',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_package_benefit_submit']); ?>
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
