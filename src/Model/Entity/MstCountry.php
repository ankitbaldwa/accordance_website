<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MstCountry Entity
 *
 * @property int $id
 * @property string $country_name
 * @property string $code
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MstCity[] $mst_cities
 * @property \App\Model\Entity\MstState[] $mst_states
 */
class MstCountry extends Entity
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
        'country_name' => true,
        'code' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'mst_cities' => true,
        'mst_states' => true,
    ];
}
