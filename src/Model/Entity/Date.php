<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Date Entity
 *
 * @property int $id
 * @property string $json
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Date extends Entity
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
        'json' => true,
        'user_id' => true,
        'user' => true
    ];
}
