<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?= $this->Form->create($product, ['id'=> 'product-form', 'novalidate'=>"novalidate"]) ?>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Name *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('name', ['label'=>false, 'class' => 'form-control product_slug','placeholder'=>'Product Name', 'required'=> false,'onload'=>"convertToSlug(this.value)", 'onkeyup'=>"convertToSlug(this.value)"]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Slug </label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <?= $this->Form->control('slug', ['label'=>false, 'class' => 'form-control','placeholder'=>'Product Slug', 'required'=> false, 'readonly'=> true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3 col-sm-12">Image</label>
    <div class="col-lg-7 col-md-7 col-sm-9">
        <?= $this->Form->control('image', ['type'=> 'file','label'=>false, 'class' => 'form-control', 'required'=> false]) ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-3"><?= $this->Html->image('products'. DS .$product->image, ['alt' => 'Product Image','width'=>'30%']) ?></div>
</div>
<div class="kt-form__actions">
    <div class="row">
        <div class="col-lg-9 ml-lg-auto">
            <?= $this->Form->button('Submit',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill btn-brand','id'=>'kt_product_submit']); ?> 
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
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products form content">
            <?= $this->Form->create($product) ?>
            <fieldset>
                <legend><?= __('Edit Product') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('image');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
