<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<div>
    <h3><?= h($status->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Label') ?></th>
            <td><?= h($status->label) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($status->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Allowed No Executor') ?></th>
            <td><?= $status->is_allowed_no_executor ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($status->tasks)): ?>
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
            <?php foreach ($status->tasks as $tasks): ?>
            <tr>
                <td><?= h($tasks->id) ?></td>
                <td><?= h($tasks->label) ?></td>
                <td><?= h($tasks->description) ?></td>
                <td><?= h($tasks->comment) ?></td>
                <td><?= h($tasks->type_id) ?></td>
                <td><?= h($tasks->author_id) ?></td>
                <td><?= h($tasks->executor_id) ?></td>
                <td><?= h($tasks->status_id) ?></td>
                <td><?= h($tasks->created_at) ?></td>
                <td><?= h($tasks->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $tasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
