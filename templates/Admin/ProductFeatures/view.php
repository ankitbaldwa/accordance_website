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
            <?= $this->Html->link(__('Edit Product Feature'), ['action' => 'edit', $productFeature->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product Feature'), ['action' => 'delete', $productFeature->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productFeature->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Product Features'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product Feature'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productFeatures view content">
            <h3><?= h($productFeature->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productFeature->has('product') ? $this->Html->link($productFeature->product->name, ['controller' => 'Products', 'action' => 'view', $productFeature->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($productFeature->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($productFeature->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($productFeature->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productFeature->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($productFeature->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($productFeature->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($productFeature->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
