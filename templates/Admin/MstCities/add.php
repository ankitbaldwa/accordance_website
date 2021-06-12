<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MstCity $mstCity
 */
$getStates_url = $this->Url->build(['prefix'=>'Admin', 'controller'=>'MstCities', 'action'=>'getStates']);
?>
<?= $this->Form->create($mstCity, ['id'=> 'cities-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Country Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('mst_country_id', ['type'=> 'select','label'=>false,'options' => $mstCountries,'empty'=>'Select Country', 'class' => 'form-control','data-url'=>$getStates_url, 'placeholder'=>'Select Country Name', 'required'=> false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">State Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('mst_state_id', ['type'=> 'select','label'=>false, 'options' => [], 'class' => 'form-control', 'placeholder'=>'Select Country First', 'empty'=>'Select Country First', 'required'=> false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">City Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->text('city_name', ['class' => 'form-control', 'placeholder'=>'City Name', 'autocomplete'=>'off', 'label'=> false, 'required'=> false]) ?>
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
            <?= $this->Html->link(__('List Mst Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="mstCities form content">
            <?= $this->Form->create($mstCity) ?>
            <fieldset>
                <legend><?= __('Add Mst City') ?></legend>
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
</div> -->
