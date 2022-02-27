<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppInfo Model
 *
 * @method \App\Model\Entity\AppInfo newEmptyEntity()
 * @method \App\Model\Entity\AppInfo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AppInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppInfo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AppInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppInfo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppInfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppInfo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppInfo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppInfo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppInfo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AppInfoTable extends Table
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

        $this->setTable('app_info');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('os_version')
            ->maxLength('os_version', 255)
            ->requirePresence('os_version', 'create')
            ->notEmptyString('os_version');

        $validator
            ->scalar('product')
            ->maxLength('product', 255)
            ->requirePresence('product', 'create')
            ->notEmptyString('product');

        $validator
            ->scalar('device_name')
            ->maxLength('device_name', 255)
            ->requirePresence('device_name', 'create')
            ->notEmptyString('device_name');

        $validator
            ->scalar('model_number')
            ->maxLength('model_number', 255)
            ->requirePresence('model_number', 'create')
            ->notEmptyString('model_number');

        $validator
            ->scalar('IMEI')
            ->maxLength('IMEI', 255)
            ->requirePresence('IMEI', 'create')
            ->notEmptyString('IMEI');

        $validator
            ->scalar('IP_address')
            ->maxLength('IP_address', 255)
            ->requirePresence('IP_address', 'create')
            ->notEmptyString('IP_address');

        $validator
            ->scalar('NetworkOperatorName')
            ->maxLength('NetworkOperatorName', 255)
            ->requirePresence('NetworkOperatorName', 'create')
            ->notEmptyString('NetworkOperatorName');

        $validator
            ->scalar('Package_name')
            ->maxLength('Package_name', 255)
            ->requirePresence('Package_name', 'create')
            ->notEmptyString('Package_name');

        $validator
            ->scalar('Android_version')
            ->maxLength('Android_version', 255)
            ->requirePresence('Android_version', 'create')
            ->notEmptyString('Android_version');

        $validator
            ->dateTime('Created')
            ->requirePresence('Created', 'create')
            ->notEmptyDateTime('Created');

        return $validator;
    }
}
