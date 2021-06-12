<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $subscription
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subscription->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Subscriptions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="subscriptions form content">
            <?= $this->Form->create($subscription) ?>
            <fieldset>
                <legend><?= __('Edit Subscription') ?></legend>
                <?php
                    echo $this->Form->control('payments_id');
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('package_id');
                    echo $this->Form->control('company_name');
                    echo $this->Form->control('company_code');
                    echo $this->Form->control('company_url');
                    echo $this->Form->control('company_db_host');
                    echo $this->Form->control('company_db_username');
                    echo $this->Form->control('comapny_db_password');
                    echo $this->Form->control('company_db_database');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
