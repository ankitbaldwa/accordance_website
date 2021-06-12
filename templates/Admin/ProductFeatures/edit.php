<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductFeature $productFeature
 */
?>
<div class="row">
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
</div>
