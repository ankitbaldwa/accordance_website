<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products view content">
            <h3><?= h($product->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($product->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($product->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($product->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($product->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($product->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Image') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->image)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Packages') ?></h4>
                <?php if (!empty($product->packages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Currency') ?></th>
                            <th><?= __('No Of Days') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Discount Per') ?></th>
                            <th><?= __('Discount Amt') ?></th>
                            <th><?= __('Tax Per') ?></th>
                            <th><?= __('Tax Amount') ?></th>
                            <th><?= __('Net Amount') ?></th>
                            <th><?= __('Is Monthly') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->packages as $packages) : ?>
                        <tr>
                            <td><?= h($packages->id) ?></td>
                            <td><?= h($packages->product_id) ?></td>
                            <td><?= h($packages->name) ?></td>
                            <td><?= h($packages->currency) ?></td>
                            <td><?= h($packages->no_of_days) ?></td>
                            <td><?= h($packages->price) ?></td>
                            <td><?= h($packages->discount_per) ?></td>
                            <td><?= h($packages->discount_amt) ?></td>
                            <td><?= h($packages->tax_per) ?></td>
                            <td><?= h($packages->tax_amount) ?></td>
                            <td><?= h($packages->net_amount) ?></td>
                            <td><?= h($packages->is_monthly) ?></td>
                            <td><?= h($packages->status) ?></td>
                            <td><?= h($packages->created) ?></td>
                            <td><?= h($packages->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Packages', 'action' => 'view', $packages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Packages', 'action' => 'edit', $packages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Packages', 'action' => 'delete', $packages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Product Features') ?></h4>
                <?php if (!empty($product->product_features)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->product_features as $productFeatures) : ?>
                        <tr>
                            <td><?= h($productFeatures->id) ?></td>
                            <td><?= h($productFeatures->product_id) ?></td>
                            <td><?= h($productFeatures->name) ?></td>
                            <td><?= h($productFeatures->description) ?></td>
                            <td><?= h($productFeatures->image) ?></td>
                            <td><?= h($productFeatures->status) ?></td>
                            <td><?= h($productFeatures->created) ?></td>
                            <td><?= h($productFeatures->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProductFeatures', 'action' => 'view', $productFeatures->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProductFeatures', 'action' => 'edit', $productFeatures->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductFeatures', 'action' => 'delete', $productFeatures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productFeatures->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
