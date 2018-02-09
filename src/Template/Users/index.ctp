<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-hover" id="table">
        <thead>
            <tr class="bg-primary">
                <th>ID</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Category_id</th>
                <th scope="col">Estatus</th>
                <th scope="col" class="actions">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            <tr v-for="date in tabledata">
                <td> {{date.id}} </td>
                <td> {{date.username}} </td>
                <td> {{date.role}} </td>
                <td> {{date.category_id}} </td>
                <td> {{date.status}} </td>
                <td class="actions">
                   <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'user.edit('+date.id+')'">
                        <i class="material-icons">&#xE22B;</i>
                    </button>
                   <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'user.delete('+date.id+')'">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
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
<?= $this->Html->script('Tabla_users') ?>
<script>
    user.setElement("users");
</script>