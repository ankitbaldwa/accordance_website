<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Testimonial $testimonial
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Testimonial'), ['action' => 'edit', $testimonial->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Testimonial'), ['action' => 'delete', $testimonial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testimonial->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Testimonials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Testimonial'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testimonials view content">
            <h3><?= h($testimonial->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($testimonial->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($testimonial->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($testimonial->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($testimonial->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($testimonial->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Detail') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($testimonial->detail)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
