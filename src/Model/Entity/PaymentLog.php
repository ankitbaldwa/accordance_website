<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentLog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $company
 * @property string $gstin
 * @property string $address
 * @property int $state
 * @property int $city
 * @property int $zip
 * @property int $package_id
 * @property float $amount
 * @property float $discount_amt
 * @property float $tax_amount
 * @property float $net_amount
 * @property string $order_id
 * @property \Cake\I18n\FrozenDate $payment_date
 * @property string $payment_id
 * @property \Cake\I18n\FrozenDate $package_start_date
 * @property \Cake\I18n\FrozenDate $package_end_date
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Payment $payment
 * @property \App\Model\Entity\PaymentsLogError[] $payments_log_errors
 */
class PaymentLog extends Entity
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
        'user_id' => true,
        'company' => true,
        'gstin' => true,
        'address' => true,
        'state' => true,
        'city' => true,
        'zip' => true,
        'package_id' => true,
        'amount' => true,
        'discount_amt' => true,
        'tax_amount' => true,
        'net_amount' => true,
        'order_id' => true,
        'payment_date' => true,
        'payment_id' => true,
        'package_start_date' => true,
        'package_end_date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'package' => true,
        'order' => true,
        'payment' => true,
        'payments_log_errors' => true,
    ];
}
