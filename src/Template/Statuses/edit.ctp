<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<div>
    <?= $this->Form->create($status) ?>
    <fieldset>
        <legend><?= __('Edit Status') ?></legend>
        <?php
            echo $this->Form->control('label');
            echo $this->Form->control('is_allowed_no_executor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
