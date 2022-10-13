<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lastname') ?></th>
            <td><?= h($user->lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($user->execute_tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Label') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col"><?= __('Author Id') ?></th>
                <th scope="col"><?= __('Executor Id') ?></th>
                <th scope="col"><?= __('Status Id') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->execute_tasks as $executeTasks): ?>
            <tr>
                <td><?= h($executeTasks->id) ?></td>
                <td><?= h($executeTasks->label) ?></td>
                <td><?= h($executeTasks->description) ?></td>
                <td><?= h($executeTasks->comment) ?></td>
                <td><?= h($executeTasks->type_id) ?></td>
                <td><?= h($executeTasks->author_id) ?></td>
                <td><?= h($executeTasks->executor_id) ?></td>
                <td><?= h($executeTasks->status_id) ?></td>
                <td><?= h($executeTasks->created_at) ?></td>
                <td><?= h($executeTasks->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $executeTasks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $executeTasks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $executeTasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $executeTasks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($user->authored_tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Label') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col"><?= __('Author Id') ?></th>
                <th scope="col"><?= __('Executor Id') ?></th>
                <th scope="col"><?= __('Status Id') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->authored_tasks as $authoredTasks): ?>
            <tr>
                <td><?= h($authoredTasks->id) ?></td>
                <td><?= h($authoredTasks->label) ?></td>
                <td><?= h($authoredTasks->description) ?></td>
                <td><?= h($authoredTasks->comment) ?></td>
                <td><?= h($authoredTasks->type_id) ?></td>
                <td><?= h($authoredTasks->author_id) ?></td>
                <td><?= h($authoredTasks->executor_id) ?></td>
                <td><?= h($authoredTasks->status_id) ?></td>
                <td><?= h($authoredTasks->created_at) ?></td>
                <td><?= h($authoredTasks->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $authoredTasks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $authoredTasks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $authoredTasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authoredTasks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
