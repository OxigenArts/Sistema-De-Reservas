<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mesage $mesage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mesage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mesage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mesage'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesage form large-9 medium-8 columns content">
    <?= $this->Form->create($mesage) ?>
    <fieldset>
        <legend><?= __('Edit Mesage') ?></legend>
        <?php
            echo $this->Form->control('json');
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
