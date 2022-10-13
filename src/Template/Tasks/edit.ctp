<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<div class="tasks form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
            echo $this->Form->control('label');
            echo $this->Form->control('description');
            echo $this->Form->control('comment');
            echo $this->Form->control('type_id',['options' => $types]);
            echo $this->Form->control('executor_id', ['options' => $executors, 'empty' => true]);
            echo $this->Form->control('status_id',['options' => $statuses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
