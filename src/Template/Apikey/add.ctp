<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apikey $apikey
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Apikey'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="apikey form large-9 medium-8 columns content">
    <?= $this->Form->create($apikey) ?>
    <fieldset>
        <legend><?= __('Generate Apikey') ?></legend>
        <?php
           /* echo $this->Form->control('api_key');
            echo $this->Form->control('user_id', ['options' => $users]);*/
        ?>
    </fieldset>
    <?= $this->Form->button(__('Gererate ApiKey')) ?>
    <?= $this->Form->end() ?>
</div>
