<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property string $label
 * @property string|null $description
 * @property string|null $comment
 * @property int $type_id
 * @property int $author_id
 * @property int|null $executor_id
 * @property int $status_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\User $author
 * @property \App\Model\Entity\User $executor
 * @property \App\Model\Entity\Status $status
 */
class Task extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'label' => true,
        'description' => true,
        'comment' => true,
        'type_id' => true,
        'author_id' => true,
        'executor_id' => true,
        'status_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'type' => true,
        'author' => true,
        'executor' => true,
        'status' => true,
    ];

    public function isAllowToEdit(User $user)
    {
        return $this->isAllowToDelete($user) || $user->id === $this->executor_id;
    }

    public function isAllowToDelete(User $user)
    {
        return $user->id === $this->author_id;
    }
}
