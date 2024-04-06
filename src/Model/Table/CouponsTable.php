<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coupons Model
 *
 * @method \App\Model\Entity\Coupon newEmptyEntity()
 * @method \App\Model\Entity\Coupon newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Coupon> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Coupon get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Coupon findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Coupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Coupon> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Coupon|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Coupon saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Coupon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Coupon>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Coupon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Coupon> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Coupon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Coupon>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Coupon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Coupon> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CouponsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('coupons');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'coupon_id',
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
            ->scalar('code')
            ->maxLength('code', 10)
            ->requirePresence('code', 'create')
            ->notEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('active')
            ->notEmptyString('active');

        $validator
            ->decimal('min_price')
            ->notEmptyString('min_price');

        $validator
            ->decimal('max_price')
            ->allowEmptyString('max_price');

        $validator
            ->decimal('discount')
            ->notEmptyString('discount');

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
        $rules->add($rules->isUnique(['code']), ['errorField' => 'code']);

        return $rules;
    }

}
