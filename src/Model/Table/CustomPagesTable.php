<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomPages Model
 *
 * @method \App\Model\Entity\CustomPage newEmptyEntity()
 * @method \App\Model\Entity\CustomPage newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomPage> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomPage get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CustomPage findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CustomPage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomPage> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomPage|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CustomPage saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CustomPage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomPage>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomPage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomPage> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomPage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomPage>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomPage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomPage> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CustomPagesTable extends Table
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

        $this->setTable('custom_pages');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('text_1')
            ->maxLength('text_1', 16777215)
            ->allowEmptyString('text_1');

        $validator
            ->scalar('text_2')
            ->maxLength('text_2', 16777215)
            ->allowEmptyString('text_2');

        $validator
            ->scalar('text_3')
            ->maxLength('text_3', 16777215)
            ->allowEmptyString('text_3');

        $validator
            ->scalar('text_4')
            ->maxLength('text_4', 16777215)
            ->allowEmptyString('text_4');

        $validator
            ->scalar('text_5')
            ->maxLength('text_5', 16777215)
            ->allowEmptyString('text_5');

        $validator
            ->scalar('string_1')
            ->maxLength('string_1', 255)
            ->allowEmptyString('string_1');

        $validator
            ->scalar('string_2')
            ->maxLength('string_2', 255)
            ->allowEmptyString('string_2');

        $validator
            ->scalar('string_3')
            ->maxLength('string_3', 255)
            ->allowEmptyString('string_3');

        $validator
            ->scalar('string_4')
            ->maxLength('string_4', 255)
            ->allowEmptyString('string_4');

        $validator
            ->scalar('string_5')
            ->maxLength('string_5', 255)
            ->allowEmptyString('string_5');

        return $validator;
    }
}
