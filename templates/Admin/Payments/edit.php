<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $payment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $payment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Payments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="payments form content">
            <?= $this->Form->create($payment) ?>
            <fieldset>
                <legend><?= __('Edit Payment') ?></legend>
                <?php
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('company');
                    echo $this->Form->control('gstin');
                    echo $this->Form->control('address');
                    echo $this->Form->control('state');
                    echo $this->Form->control('city');
                    echo $this->Form->control('zip');
                    echo $this->Form->control('package_id');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('discount_amt');
                    echo $this->Form->control('tax_amount');
                    echo $this->Form->control('net_amount');
                    echo $this->Form->control('order_id');
                    echo $this->Form->control('payment_date');
                    echo $this->Form->control('payment_id');
                    echo $this->Form->control('package_start_date');
                    echo $this->Form->control('package_end_date');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
