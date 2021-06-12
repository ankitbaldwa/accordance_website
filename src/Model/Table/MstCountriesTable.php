<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MstCountries Model
 *
 * @property \App\Model\Table\MstCitiesTable&\Cake\ORM\Association\HasMany $MstCities
 * @property \App\Model\Table\MstStatesTable&\Cake\ORM\Association\HasMany $MstStates
 *
 * @method \App\Model\Entity\MstCountry newEmptyEntity()
 * @method \App\Model\Entity\MstCountry newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MstCountry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MstCountry get($primaryKey, $options = [])
 * @method \App\Model\Entity\MstCountry findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MstCountry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MstCountry[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MstCountry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstCountry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstCountry[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCountry[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCountry[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstCountry[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MstCountriesTable extends Table
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

        $this->setTable('mst_countries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MstCities', [
            'foreignKey' => 'mst_country_id',
        ]);
        $this->hasMany('MstStates', [
            'foreignKey' => 'mst_country_id',
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
            ->scalar('country_name')
            ->maxLength('country_name', 255)
            ->requirePresence('country_name', 'create')
            ->notEmptyString('country_name');

        /*$validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('status')
            ->notEmptyString('status');*/

        return $validator;
    }
}
