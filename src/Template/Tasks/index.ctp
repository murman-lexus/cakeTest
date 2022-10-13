<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */
?>
<h3>
    <?= __('Tasks') ?>
    <?= $this->Html->link(__('New Task'), ['action' => 'add'],['class'=>'btn btn-primary']) ?>
</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col"><?= __('id') ?></th>
            <th scope="col"><?= __('label') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Types.label',__('Type')) ?></th>
            <th scope="col"><?= __('status') ?></th>
            <th scope="col"><?= __('author') ?></th>
            <th scope="col"><?= __('executor') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>

            <td><?= $this->Number->format($task->id) ?></td>
            <td><?= h($task->label) ?></td>
            <td><?= $task->has('type') ? $this->Html->link($task->type->label, ['controller' => 'Types', 'action' => 'view', $task->type->id]) : '' ?></td>
            <td><?= $task->has('status') ? $this->Html->link($task->status->label, ['controller' => 'Statuses', 'action' => 'view', $task->status->id]) : '' ?></td>
            <td><?= $task->has('author') ? $this->Html->link($task->author->fullname, ['controller' => 'Users', 'action' => 'view', $task->author->id]) : '' ?></td>
            <td><?= $task->has('executor') ? $this->Html->link($task->executor->fullname, ['controller' => 'Users', 'action' => 'view', $task->executor->id]) : '' ?></td>
            <td><?= h($task->created_at->format('d-m-Y H:i')) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $task->id],['class' => 'btn btn-light']) ?>
                <?php if ($task->isAllowToEdit($this->Identity->get('id'))): ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id],['class' => 'btn btn-warning']) ?>
                <?php endif;?>
                <?php if ($task->isAllowToDelete($this->Identity->get('id'))): ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id), 'class' => 'btn btn-danger']) ?>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->element('pagination') ?>

