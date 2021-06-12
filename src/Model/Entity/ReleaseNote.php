<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReleaseNote Entity
 *
 * @property int $id
 * @property float $version
 * @property int $package_id
 * @property string $release_notes
 * @property string $release_notes_pdf
 * @property string $key_points
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Package $package
 */
class ReleaseNote extends Entity
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
        'version' => true,
        'package_id' => true,
        'release_notes' => true,
        'release_notes_pdf' => true,
        'key_points' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'package' => true,
    ];
}
