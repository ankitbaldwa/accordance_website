<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property int $id
 * @property int $payments_id
 * @property int $user_id
 * @property int $package_id
 * @property string $company_name
 * @property string $company_code
 * @property string $company_url
 * @property string $company_db_host
 * @property string $company_db_username
 * @property string $comapny_db_password
 * @property string $company_db_database
 * @property float $amount
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $status
 * @property int $created
 * @property int $modified
 *
 * @property \App\Model\Entity\Payment $payment
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Package $package
 */
class Subscription extends Entity
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
        'payments_id' => true,
        'user_id' => true,
        'package_id' => true,
        'company_name' => true,
        'company_code' => true,
        'company_url' => true,
        'company_db_host' => true,
        'company_db_username' => true,
        'comapny_db_password' => true,
        'company_db_database' => true,
        'amount' => true,
        'start_date' => true,
        'end_date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'payment' => true,
        'user' => true,
        'package' => true,
    ];
}
