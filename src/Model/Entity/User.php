<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher; 

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property int $mobile
 * @property string $profile
 * @property string $billing_address
 * @property string $country
 * @property string $state
 * @property string $city
 * @property int $pincode
 * @property string $company
 * @property string $gstin_no
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\PaymentsLog[] $payments_log
 * @property \App\Model\Entity\Subscription[] $subscription
 */
class User extends Entity
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
        'name' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'mobile' => true,
        'profile' => true,
        'billing_address' => true,
        'country' => true,
        'state' => true,
        'city' => true,
        'pincode' => true,
        'company' => true,
        'gstin_no' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'payments' => true,
        'payments_log' => true,
        'subscription' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
