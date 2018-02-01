<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apikey[]|\Cake\Collection\CollectionInterface $apikey
 */

?>

<div class="apikey index large-9 medium-8 columns content">
    <h3><?= __('Apikey') ?></h3>


    <table class="table">
  <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('api_key') ?></th>
        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($apikey as $apikey): ?>
            <tr>
                <th scope="row"><?= $this->Number->format($apikey->id) ?></th>
                <td><?= h($apikey->api_key) ?></td>
                <td><?= $apikey->has('user') ? $this->Html->link($apikey->user->id, ['controller' => 'Users', 'action' => 'view', $apikey->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $apikey->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apikey->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apikey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apikey->id)]) ?>
                </td>
            </tr>
    <?php endforeach; ?>
  </tbody>
</table>


    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('api_key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apikey as $apikey): ?>
            <tr>
                <td><?= $this->Number->format($apikey->id) ?></td>
                <td><?= h($apikey->api_key) ?></td>
                <td><?= $apikey->has('user') ? $this->Html->link($apikey->user->id, ['controller' => 'Users', 'action' => 'view', $apikey->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $apikey->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apikey->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apikey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apikey->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
