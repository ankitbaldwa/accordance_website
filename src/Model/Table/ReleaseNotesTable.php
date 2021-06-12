<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReleaseNotes Model
 *
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 *
 * @method \App\Model\Entity\ReleaseNote newEmptyEntity()
 * @method \App\Model\Entity\ReleaseNote newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ReleaseNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReleaseNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReleaseNote findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ReleaseNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReleaseNote[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReleaseNote|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReleaseNote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReleaseNote[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReleaseNote[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReleaseNote[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReleaseNote[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReleaseNotesTable extends Table
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

        $this->setTable('release_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
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
            ->numeric('version')
            ->requirePresence('version', 'create')
            ->notEmptyString('version');

        $validator
            ->scalar('release_notes')
            ->maxLength('release_notes', 255)
            ->requirePresence('release_notes', 'create')
            ->notEmptyString('release_notes');

        $validator
            ->scalar('release_notes_pdf')
            ->maxLength('release_notes_pdf', 255)
            ->requirePresence('release_notes_pdf', 'create')
            ->notEmptyString('release_notes_pdf');

        $validator
            ->scalar('key_points')
            ->requirePresence('key_points', 'create')
            ->notEmptyString('key_points');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
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
        $rules->add($rules->existsIn(['package_id'], 'Packages'), ['errorField' => 'package_id']);

        return $rules;
    }
}
