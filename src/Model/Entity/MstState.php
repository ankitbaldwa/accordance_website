<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MstState Entity
 *
 * @property int $id
 * @property int $mst_country_id
 * @property string $state_name
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MstCountry $mst_country
 * @property \App\Model\Entity\MstCity[] $mst_cities
 */
class MstState extends Entity
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
        'state_name' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'mst_country' => true,
        'mst_cities' => true,
    ];
}
