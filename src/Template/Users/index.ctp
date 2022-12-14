<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<h3>
    <?= __('Users') ?>
    <?= $this->Html->link(__('New User'), ['action' => 'add'],['class'=>'btn btn-primary']) ?>
</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('firstname') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lastname') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->firstname) ?></td>
            <td><?= h($user->lastname) ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id],['class' => 'btn btn-light']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class' => 'btn btn-warning']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->element('pagination') ?>
