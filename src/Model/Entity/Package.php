<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $currency
 * @property int $no_of_days
 * @property float $price
 * @property float $discount_per
 * @property float $discount_amt
 * @property float $tax_per
 * @property float $tax_amount
 * @property float $net_amount
 * @property string $is_monthly
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Enquiry[] $enquiries
 * @property \App\Model\Entity\PackageBenefit[] $package_benefits
 * @property \App\Model\Entity\PaymentLog[] $payment_logs
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\ReleaseNote[] $release_notes
 * @property \App\Model\Entity\Subscription[] $subscriptions
 */
class Package extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_id' => true,
        'name' => true,
        'currency' => true,
        'no_of_days' => true,
        'price' => true,
        'discount_per' => true,
        'discount_amt' => true,
        'tax_per' => true,
        'tax_amount' => true,
        'net_amount' => true,
        'is_monthly' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'enquiries' => true,
        'package_benefits' => true,
        'payment_logs' => true,
        'payments' => true,
        'release_notes' => true,
        'subscriptions' => true,
    ];
}
