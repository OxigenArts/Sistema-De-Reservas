<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apikey $apikey
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $apikey->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $apikey->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Apikey'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="apikey form large-9 medium-8 columns content">
    <?= $this->Form->create($apikey) ?>
    <fieldset>
        <legend><?= __('Edit Apikey') ?></legend>
        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('User_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Api_key') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apikey as $key): ?>
            <tr>
                <td><?= h($key->user_id) ?></td>
                <td><?= h($key->api_key) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </fieldset>
    <?= $this->Form->button(__('Editar Apikey')) ?>
    <?= $this->Form->end() ?>
</div>
