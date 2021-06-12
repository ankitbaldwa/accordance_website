<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packages view content">
            <h3><?= h($package->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $package->has('product') ? $this->Html->link($package->product->name, ['controller' => 'Products', 'action' => 'view', $package->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($package->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency') ?></th>
                    <td><?= h($package->currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Monthly') ?></th>
                    <td><?= h($package->is_monthly) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($package->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($package->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('No Of Days') ?></th>
                    <td><?= $this->Number->format($package->no_of_days) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($package->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Per') ?></th>
                    <td><?= $this->Number->format($package->discount_per) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Amt') ?></th>
                    <td><?= $this->Number->format($package->discount_amt) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax Per') ?></th>
                    <td><?= $this->Number->format($package->tax_per) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax Amount') ?></th>
                    <td><?= $this->Number->format($package->tax_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Net Amount') ?></th>
                    <td><?= $this->Number->format($package->net_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($package->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($package->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Enquiries') ?></h4>
                <?php if (!empty($package->enquiries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Mobile') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->enquiries as $enquiries) : ?>
                        <tr>
                            <td><?= h($enquiries->id) ?></td>
                            <td><?= h($enquiries->package_id) ?></td>
                            <td><?= h($enquiries->name) ?></td>
                            <td><?= h($enquiries->email) ?></td>
                            <td><?= h($enquiries->mobile) ?></td>
                            <td><?= h($enquiries->description) ?></td>
                            <td><?= h($enquiries->created) ?></td>
                            <td><?= h($enquiries->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Enquiries', 'action' => 'view', $enquiries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Enquiries', 'action' => 'edit', $enquiries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Enquiries', 'action' => 'delete', $enquiries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enquiries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Package Benefits') ?></h4>
                <?php if (!empty($package->package_benefits)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->package_benefits as $packageBenefits) : ?>
                        <tr>
                            <td><?= h($packageBenefits->id) ?></td>
                            <td><?= h($packageBenefits->package_id) ?></td>
                            <td><?= h($packageBenefits->title) ?></td>
                            <td><?= h($packageBenefits->created) ?></td>
                            <td><?= h($packageBenefits->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PackageBenefits', 'action' => 'view', $packageBenefits->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PackageBenefits', 'action' => 'edit', $packageBenefits->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PackageBenefits', 'action' => 'delete', $packageBenefits->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageBenefits->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Payment Logs') ?></h4>
                <?php if (!empty($package->payment_logs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Company') ?></th>
                            <th><?= __('Gstin') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('City') ?></th>
                            <th><?= __('Zip') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Discount Amt') ?></th>
                            <th><?= __('Tax Amount') ?></th>
                            <th><?= __('Net Amount') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Payment Date') ?></th>
                            <th><?= __('Payment Id') ?></th>
                            <th><?= __('Package Start Date') ?></th>
                            <th><?= __('Package End Date') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->payment_logs as $paymentLogs) : ?>
                        <tr>
                            <td><?= h($paymentLogs->id) ?></td>
                            <td><?= h($paymentLogs->user_id) ?></td>
                            <td><?= h($paymentLogs->company) ?></td>
                            <td><?= h($paymentLogs->gstin) ?></td>
                            <td><?= h($paymentLogs->address) ?></td>
                            <td><?= h($paymentLogs->state) ?></td>
                            <td><?= h($paymentLogs->city) ?></td>
                            <td><?= h($paymentLogs->zip) ?></td>
                            <td><?= h($paymentLogs->package_id) ?></td>
                            <td><?= h($paymentLogs->amount) ?></td>
                            <td><?= h($paymentLogs->discount_amt) ?></td>
                            <td><?= h($paymentLogs->tax_amount) ?></td>
                            <td><?= h($paymentLogs->net_amount) ?></td>
                            <td><?= h($paymentLogs->order_id) ?></td>
                            <td><?= h($paymentLogs->payment_date) ?></td>
                            <td><?= h($paymentLogs->payment_id) ?></td>
                            <td><?= h($paymentLogs->package_start_date) ?></td>
                            <td><?= h($paymentLogs->package_end_date) ?></td>
                            <td><?= h($paymentLogs->status) ?></td>
                            <td><?= h($paymentLogs->created) ?></td>
                            <td><?= h($paymentLogs->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PaymentLogs', 'action' => 'view', $paymentLogs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PaymentLogs', 'action' => 'edit', $paymentLogs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PaymentLogs', 'action' => 'delete', $paymentLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentLogs->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Payments') ?></h4>
                <?php if (!empty($package->payments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Company') ?></th>
                            <th><?= __('Gstin') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('City') ?></th>
                            <th><?= __('Zip') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Discount Amt') ?></th>
                            <th><?= __('Tax Amount') ?></th>
                            <th><?= __('Net Amount') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Payment Date') ?></th>
                            <th><?= __('Payment Id') ?></th>
                            <th><?= __('Package Start Date') ?></th>
                            <th><?= __('Package End Date') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->payments as $payments) : ?>
                        <tr>
                            <td><?= h($payments->id) ?></td>
                            <td><?= h($payments->user_id) ?></td>
                            <td><?= h($payments->company) ?></td>
                            <td><?= h($payments->gstin) ?></td>
                            <td><?= h($payments->address) ?></td>
                            <td><?= h($payments->state) ?></td>
                            <td><?= h($payments->city) ?></td>
                            <td><?= h($payments->zip) ?></td>
                            <td><?= h($payments->package_id) ?></td>
                            <td><?= h($payments->amount) ?></td>
                            <td><?= h($payments->discount_amt) ?></td>
                            <td><?= h($payments->tax_amount) ?></td>
                            <td><?= h($payments->net_amount) ?></td>
                            <td><?= h($payments->order_id) ?></td>
                            <td><?= h($payments->payment_date) ?></td>
                            <td><?= h($payments->payment_id) ?></td>
                            <td><?= h($payments->package_start_date) ?></td>
                            <td><?= h($payments->package_end_date) ?></td>
                            <td><?= h($payments->status) ?></td>
                            <td><?= h($payments->created) ?></td>
                            <td><?= h($payments->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Release Notes') ?></h4>
                <?php if (!empty($package->release_notes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Version') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Release Notes') ?></th>
                            <th><?= __('Release Notes Pdf') ?></th>
                            <th><?= __('Key Points') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->release_notes as $releaseNotes) : ?>
                        <tr>
                            <td><?= h($releaseNotes->id) ?></td>
                            <td><?= h($releaseNotes->version) ?></td>
                            <td><?= h($releaseNotes->package_id) ?></td>
                            <td><?= h($releaseNotes->release_notes) ?></td>
                            <td><?= h($releaseNotes->release_notes_pdf) ?></td>
                            <td><?= h($releaseNotes->key_points) ?></td>
                            <td><?= h($releaseNotes->status) ?></td>
                            <td><?= h($releaseNotes->created) ?></td>
                            <td><?= h($releaseNotes->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ReleaseNotes', 'action' => 'view', $releaseNotes->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ReleaseNotes', 'action' => 'edit', $releaseNotes->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReleaseNotes', 'action' => 'delete', $releaseNotes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $releaseNotes->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Subscriptions') ?></h4>
                <?php if (!empty($package->subscriptions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Payments Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Package Id') ?></th>
                            <th><?= __('Company Name') ?></th>
                            <th><?= __('Company Code') ?></th>
                            <th><?= __('Company Url') ?></th>
                            <th><?= __('Company Db Host') ?></th>
                            <th><?= __('Company Db Username') ?></th>
                            <th><?= __('Comapny Db Password') ?></th>
                            <th><?= __('Company Db Database') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($package->subscriptions as $subscriptions) : ?>
                        <tr>
                            <td><?= h($subscriptions->id) ?></td>
                            <td><?= h($subscriptions->payments_id) ?></td>
                            <td><?= h($subscriptions->user_id) ?></td>
                            <td><?= h($subscriptions->package_id) ?></td>
                            <td><?= h($subscriptions->company_name) ?></td>
                            <td><?= h($subscriptions->company_code) ?></td>
                            <td><?= h($subscriptions->company_url) ?></td>
                            <td><?= h($subscriptions->company_db_host) ?></td>
                            <td><?= h($subscriptions->company_db_username) ?></td>
                            <td><?= h($subscriptions->comapny_db_password) ?></td>
                            <td><?= h($subscriptions->company_db_database) ?></td>
                            <td><?= h($subscriptions->amount) ?></td>
                            <td><?= h($subscriptions->start_date) ?></td>
                            <td><?= h($subscriptions->end_date) ?></td>
                            <td><?= h($subscriptions->status) ?></td>
                            <td><?= h($subscriptions->created) ?></td>
                            <td><?= h($subscriptions->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Subscriptions', 'action' => 'view', $subscriptions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Subscriptions', 'action' => 'edit', $subscriptions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subscriptions', 'action' => 'delete', $subscriptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptions->id)]) ?>
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
