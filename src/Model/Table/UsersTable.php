<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CategoryTable|\Cake\ORM\Association\BelongsTo $Category
 * @property \App\Model\Table\SubcategoriesTable|\Cake\ORM\Association\BelongsTo $Subcategories
 * @property |\Cake\ORM\Association\BelongsTo $Profiles
 * @property \App\Model\Table\ApikeyTable|\Cake\ORM\Association\HasMany $Apikey
 * @property \App\Model\Table\DateTable|\Cake\ORM\Association\HasMany $Date
 * @property \App\Model\Table\DirectoryTable|\Cake\ORM\Association\HasMany $Directory
 * @property \App\Model\Table\FormsTable|\Cake\ORM\Association\HasMany $Forms
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\HasMany $Photos
 * @property \App\Model\Table\ProfileTable|\Cake\ORM\Association\HasMany $Profile
 * @property \App\Model\Table\ReservationTable|\Cake\ORM\Association\HasMany $Reservation
 * @property \App\Model\Table\RoutinesTable|\Cake\ORM\Association\HasMany $Routines
 * @property \App\Model\Table\SubcategoryTable|\Cake\ORM\Association\HasMany $Subcategory
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Category', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('Apikey', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Date', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Directory', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Forms', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Photos', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Profile', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reservation', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Routines', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Subcategory', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['category_id'], 'Category'));
        $rules->add($rules->existsIn(['subcategory_id'], 'Subcategories'));
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'));

        return $rules;
    }
}
