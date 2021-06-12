<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MstStates Model
 *
 * @property \App\Model\Table\MstCountriesTable&\Cake\ORM\Association\BelongsTo $MstCountries
 * @property \App\Model\Table\MstCitiesTable&\Cake\ORM\Association\HasMany $MstCities
 *
 * @method \App\Model\Entity\MstState newEmptyEntity()
 * @method \App\Model\Entity\MstState newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MstState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MstState get($primaryKey, $options = [])
 * @method \App\Model\Entity\MstState findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MstState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MstState[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MstState|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstState saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstState[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstState[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstState[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstState[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MstStatesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('mst_states');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MstCountries', [
            'foreignKey' => 'mst_country_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('MstCities', [
            'foreignKey' => 'mst_state_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('state_name')
            ->maxLength('state_name', 255)
            ->requirePresence('state_name', 'create')
            ->notEmptyString('state_name');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['mst_country_id'], 'MstCountries'), ['errorField' => 'mst_country_id']);

        return $rules;
    }
}
