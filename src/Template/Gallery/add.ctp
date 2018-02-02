<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Gallery'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Profile'), ['controller' => 'Profile', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profile', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="gallery form large-9 medium-8 columns content">
    <?= $this->Form->create($gallery) ?>
    <fieldset>
        <legend><?= __('Add Gallery') ?></legend>
        <?php
            echo $this->Form->control('url');
            echo $this->Form->control('profile_id', ['options' => $profile]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
