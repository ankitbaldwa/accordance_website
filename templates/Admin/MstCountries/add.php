<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $mstCountry
 */
?>
<?= $this->Form->create($mstCountry, ['id'=> 'countries-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Country Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->text('country_name', ['class' => 'form-control', 'placeholder'=>'Country Name', 'autocomplete'=>'off']) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Country Code</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->text('code', ['class' => 'form-control', 'placeholder'=>'Country Code', 'autocomplete'=>'off']) ?>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit ',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_countries_submit']); ?> 
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
