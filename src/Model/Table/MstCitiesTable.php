<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MstCities Model
 *
 * @property \App\Model\Table\MstCountriesTable&\Cake\ORM\Association\BelongsTo $MstCountries
 * @property \App\Model\Table\MstStatesTable&\Cake\ORM\Association\BelongsTo $MstStates
 *
 * @method \App\Model\Entity\MstCity newEmptyEntity()
 * @method \App\Model\Entity\MstCity newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MstCity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MstCity get($primaryKey, $options = [])
 * @method \App\Model\Entity\MstCity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MstCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MstCity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MstCity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstCity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstCity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MstCitiesTable extends Table
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

        $this->setTable('mst_cities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MstCountries', [
            'foreignKey' => 'mst_country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MstStates', [
            'foreignKey' => 'mst_state_id',
            'joinType' => 'INNER',
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
            ->scalar('city_name')
            ->maxLength('city_name', 255)
            ->requirePresence('city_name', 'create')
            ->notEmptyString('city_name');

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
        $rules->add($rules->existsIn(['mst_state_id'], 'MstStates'), ['errorField' => 'mst_state_id']);

        return $rules;
    }
}
