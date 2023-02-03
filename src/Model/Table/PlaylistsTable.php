<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Playlists Model
 *
 * @property \App\Model\Table\ContentsTable&\Cake\ORM\Association\HasMany $Contents
 *
 * @method \App\Model\Entity\Playlist newEmptyEntity()
 * @method \App\Model\Entity\Playlist newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Playlist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Playlist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Playlist findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Playlist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Playlist[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Playlist|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playlist saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playlist[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Playlist[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Playlist[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Playlist[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlaylistsTable extends Table
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

        $this->setTable('playlists');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Contents', [
            'foreignKey' => 'playlist_id',
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 200)
            ->allowEmptyString('description');

        $validator
            ->scalar('author')
            ->maxLength('author', 150)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
