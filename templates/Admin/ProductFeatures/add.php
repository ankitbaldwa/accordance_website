<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductFeature $productFeature
 */
?>
<?= $this->Form->create($productFeature, ['enctype' => 'multipart/form-data', 'id'=> 'product-feature-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Product</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-control', 'escape' => false, 'label' => false, 'readonly'=>true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('name', ['class' => 'form-control', 'placeholder'=>'Feature Name', 'autocomplete'=>'off', 'escape' => false, 'label' => false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Description</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('description', ['class' => 'form-control', 'placeholder'=>'Feature Description', 'autocomplete'=>'off', 'escape' => false, 'label' => false]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Image</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('image', ['class' => 'form-control', 'type' => 'file', 'autocomplete'=>'off', 'escape' => false, 'label' => false]) ?>
    </div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit ',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_product_feature_submit']); ?> 
            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
