<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<?= $this->Form->create($package, ['enctype' => 'multipart/form-data', 'id'=> 'package-form', 'novalidate'=>"novalidate"]) ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label">Product *</label>
            <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-control', 'escape' => false, 'label' => false, 'readonly'=>true]) ?>
        </div>
        <div class="form-group">
            <label class="col-form-label">Name *</label>
            <?= $this->Form->control('name', ['class' => 'form-control', 'placeholder'=>'Package Name', 'autocomplete'=>'off', 'escape' => false, 'label' => false]) ?>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Is Monthly</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--brand">
                    <label>
                    <?= $this->Form->checkbox('is_monthly', ['label' => false, 'hiddenField'=>false, 'id'=>"is_monthly", "required"=> false]) ?>
                    <span></span>
                    </label>
                </span>
            </div>
        </div>
        <div class="form-group is_monthly" style="display:none;">
            <label class="col-form-label">No of day's</label>
            <?= $this->Form->control('no_of_days', ['class' => 'form-control', 'type' => 'number', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'placeholder'=> 'No of Day\'s', "required"=> false]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label">Price</label>
            <div class="row">
                <div class="col-lg-5 col-md-3 col-sm-12">
                    <?= $this->Form->control('currency', ['class' => 'form-control', 'placeholder'=>'Currency', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'value'=>'INR', 'readonly', "required"=> false]) ?>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <?= $this->Form->control('price', ['class' => 'form-control', 'placeholder'=>'Price', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'id'=>'price', "required"=> false]) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label">Discount</label>
            <div class="row">
                <div class="col-lg-5 col-md-2 col-sm-12">
                    <?= $this->Form->control('discount_per', ['class' => 'form-control', 'type' => 'number', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'placeholder'=> '%', 'value'=>'0%', "required"=> false]) ?>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <?= $this->Form->control('discount_amt', ['class' => 'form-control', 'placeholder'=>'Discount Amount', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'readonly', 'id'=>'discount_amt', "required"=> false]) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label">Tax</label>
            <div class="row">
                <div class="col-lg-5 col-md-2 col-sm-12">
                    <?= $this->Form->control('tax_per', ['class' => 'form-control', 'placeholder'=>'%', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'value'=>'0%','id'=>'tax_par', "required"=> false]) ?>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <?= $this->Form->control('tax_amount', ['class' => 'form-control', 'placeholder'=>'Tax Amount', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'readonly', 'id'=>'tax_amount', "required"=> false]) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label">Net Amount</label>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= $this->Form->control('net_amount', ['class' => 'form-control', 'placeholder'=>'Net Amount', 'autocomplete'=>'off', 'escape' => false, 'label' => false, 'readonly', 'id'=>'net_amount', "required"=> false]) ?>
            </div>
        </div>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-12 ml-lg-auto">
            <?= $this->Form->button('Submit ',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_package_submit']); ?> 
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
<!-- <div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packages form content">
            <?= $this->Form->create($package) ?>
            <fieldset>
                <legend><?= __('Add Package') ?></legend>
                <?php
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('currency');
                    echo $this->Form->control('no_of_days');
                    echo $this->Form->control('price');
                    echo $this->Form->control('discount_per');
                    echo $this->Form->control('discount_amt');
                    echo $this->Form->control('tax_per');
                    echo $this->Form->control('tax_amount');
                    echo $this->Form->control('net_amount');
                    echo $this->Form->control('is_monthly');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
