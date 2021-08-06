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
        <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-control', 'name'=>'product_name', 'escape' => false, 'label' => false, 'readonly'=>true]) ?>
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
<!-- <div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productFeature->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productFeature->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Product Features'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productFeatures form content">
            <?= $this->Form->create($productFeature) ?>
            <fieldset>
                <legend><?= __('Edit Product Feature') ?></legend>
                <?php
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('image');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
