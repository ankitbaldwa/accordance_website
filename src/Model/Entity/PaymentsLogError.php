<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentsLogError Entity
 *
 * @property int $id
 * @property int $payment_log_id
 * @property string $payment_id
 * @property float $amount
 * @property string $code
 * @property string $description
 * @property string $json
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\PaymentLog $payment_log
 * @property \App\Model\Entity\Payment $payment
 */
class PaymentsLogError extends Entity
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
        'payment_log_id' => true,
        'payment_id' => true,
        'amount' => true,
        'code' => true,
        'description' => true,
        'json' => true,
        'created' => true,
        'payment_log' => true,
        'payment' => true,
    ];
}
