<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MstCity Entity
 *
 * @property int $id
 * @property int $mst_country_id
 * @property int $mst_state_id
 * @property string $city_name
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MstCountry $mst_country
 * @property \App\Model\Entity\MstState $mst_state
 */
class MstCity extends Entity
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
        'mst_country_id' => true,
        'mst_state_id' => true,
        'city_name' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'mst_country' => true,
        'mst_state' => true,
    ];
}
