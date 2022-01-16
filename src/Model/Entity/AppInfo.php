<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppInfo Entity
 *
 * @property int $id
 * @property string $os_version
 * @property string $product
 * @property string $device_name
 * @property string $model_number
 * @property string $IMEI
 * @property string $IP_address
 * @property string $NetworkOperatorName
 * @property string $Package_name
 * @property string $Android_version
 * @property \Cake\I18n\FrozenTime $Created
 */
class AppInfo extends Entity
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
        'os_version' => true,
        'product' => true,
        'device_name' => true,
        'model_number' => true,
        'IMEI' => true,
        'IP_address' => true,
        'NetworkOperatorName' => true,
        'Package_name' => true,
        'Android_version' => true,
        'Created' => true,
    ];
}
