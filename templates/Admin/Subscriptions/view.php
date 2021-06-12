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
            <?= $this->Html->link(__('Edit Subscription'), ['action' => 'edit', $subscription->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Subscription'), ['action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Subscriptions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Subscription'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="subscriptions view content">
            <h3><?= h($subscription->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Company Name') ?></th>
                    <td><?= h($subscription->company_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Code') ?></th>
                    <td><?= h($subscription->company_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Db Host') ?></th>
                    <td><?= h($subscription->company_db_host) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Db Username') ?></th>
                    <td><?= h($subscription->company_db_username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Comapny Db Password') ?></th>
                    <td><?= h($subscription->comapny_db_password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Db Database') ?></th>
                    <td><?= h($subscription->company_db_database) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($subscription->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subscription->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payments Id') ?></th>
                    <td><?= $this->Number->format($subscription->payments_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($subscription->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Id') ?></th>
                    <td><?= $this->Number->format($subscription->package_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($subscription->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= $this->Number->format($subscription->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= $this->Number->format($subscription->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($subscription->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($subscription->end_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Company Url') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($subscription->company_url)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
