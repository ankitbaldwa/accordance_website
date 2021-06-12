<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MstState $mstState
 */
?>
<?= $this->Form->create($mstState, ['id'=> 'states-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Country Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('mst_country_id', ['type'=> 'select','label'=>false,'options' => $mstCountries,'empty'=>'Select Country', 'class' => 'form-control', 'placeholder'=>'Select Country Name', 'required'=> false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">State Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->text('state_name', ['class' => 'form-control', 'placeholder'=>'State Name', 'autocomplete'=>'off', 'label'=> false, 'required'=> false]) ?>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit ',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_states_submit']); ?> 
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
<!-- <div class="row">
    <div class="column-responsive column-80">
        <div class="mstStates form content">
            <?= $this->Form->create($mstState) ?>
            <fieldset>
                <legend><?= __('Add Mst State') ?></legend>
                <?php
                    echo $this->Form->control('mst_country_id', ['options' => $mstCountries]);
                    echo $this->Form->control('state_name');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->