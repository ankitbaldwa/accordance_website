<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @property \App\Model\Table\EnquiriesTable&\Cake\ORM\Association\HasMany $Enquiries
 * @property \App\Model\Table\PackageBenefitsTable&\Cake\ORM\Association\HasMany $PackageBenefits
 * @property \App\Model\Table\PaymentLogsTable&\Cake\ORM\Association\HasMany $PaymentLogs
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\ReleaseNotesTable&\Cake\ORM\Association\HasMany $ReleaseNotes
 * @property \App\Model\Table\SubscriptionsTable&\Cake\ORM\Association\HasMany $Subscriptions
 *
 * @method \App\Model\Entity\Package newEmptyEntity()
 * @method \App\Model\Entity\Package newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Package[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Package get($primaryKey, $options = [])
 * @method \App\Model\Entity\Package findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Package[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Package|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Enquiries', [
            'foreignKey' => 'package_id',
        ]);
        $this->hasMany('PackageBenefits', [
            'foreignKey' => 'package_id',
        ]);
        $this->hasMany('PaymentLogs', [
            'foreignKey' => 'package_id',
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'package_id',
        ]);
        $this->hasMany('ReleaseNotes', [
            'foreignKey' => 'package_id',
        ]);
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'package_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 255)
            ->requirePresence('currency', 'create')
            ->notEmptyString('currency');

        $validator
            ->integer('no_of_days')
            ->requirePresence('no_of_days', 'create')
            ->notEmptyString('no_of_days');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->numeric('discount_per')
            ->requirePresence('discount_per', 'create')
            ->notEmptyString('discount_per');

        $validator
            ->numeric('discount_amt')
            ->requirePresence('discount_amt', 'create')
            ->notEmptyString('discount_amt');

        $validator
            ->numeric('tax_per')
            ->requirePresence('tax_per', 'create')
            ->notEmptyString('tax_per');

        $validator
            ->numeric('tax_amount')
            ->requirePresence('tax_amount', 'create')
            ->notEmptyString('tax_amount');

        $validator
            ->numeric('net_amount')
            ->requirePresence('net_amount', 'create')
            ->notEmptyString('net_amount');

        $validator
            ->scalar('is_monthly')
            ->notEmptyString('is_monthly');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
