<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type[]|\Cake\Collection\CollectionInterface $types
 */
?>
<h3>
    <?= __('Types') ?>
    <?= $this->Html->link(__('New Type'), ['action' => 'add'],['class'=>'btn btn-primary']) ?>
</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('label') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($types as $type): ?>
        <tr>
            <td><?= $this->Number->format($type->id) ?></td>
            <td><?= h($type->label) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $type->id],['class' => 'btn btn-light']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $type->id],['class' => 'btn btn-warning']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->id), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->element('pagination') ?>

