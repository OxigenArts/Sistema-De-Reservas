<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property int $category_id
 * @property string $status
 * @property int $subcategory_id
 * @property int $profile_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Subcategory[] $subcategory
 * @property \App\Model\Entity\Apikey[] $apikey
 * @property \App\Model\Entity\Date[] $date
 * @property \App\Model\Entity\Directory[] $directory
 * @property \App\Model\Entity\Form[] $forms
 * @property \App\Model\Entity\Photo[] $photos
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\Reservation[] $reservation
 * @property \App\Model\Entity\Routine[] $routines
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
        'username' => true,
        'password' => true,
        'role' => true,
        'category_id' => true,
        'status' => true,
        'subcategory_id' => true,
        'profile_id' => true,
        'category' => true,
        'subcategory' => true,
        'apikey' => true,
        'date' => true,
        'directory' => true,
        'forms' => true,
        'photos' => true,
        'profile' => true,
        'reservation' => true,
        'routines' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
