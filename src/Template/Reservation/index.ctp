<?= $this->Html->css('date') ?>
<div class="table-responsive">
<?php
$this->assign('title', "Reservaciones");

?>
<table class="mdl-shadow--2dp table" style="width: 100%;" id="table">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Datos</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="date in tabledata">
                <td>{{date.id}}</td>
                <td>
                    <p v-for="(value, key) in date.name.data">
                        <span class="mdl-chip" :id="date.id+key">
                            <span class="mdl-chip__text">{{key}} ({{value}})</span>
                        </span>
                        
                    </p>
                </td>
                <td>
                    {{date.name.msg}}
                </td>
                <td>
                    <p :class="date.status">
                        {{date.status}}
                    </p>
                </td>
                <td>
                    {{dateFormatted(date.name.date)}}
                </td>
                <td>
                    {{date.name.time.hour}}:{{date.name.time.minute}}
                </td>
                <td>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.delete('+date.id+')'">
                        <i class="material-icons">delete</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.edit('+date.id+')'">
                        <i class="material-icons">create</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.accept('+date.id+')'">
                        <i class="material-icons">done</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.dismiss('+date.id+')'">
                        <i class="material-icons">clear</i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    

    <?= $this->Html->script('table') ?>
<script>
    table.setElement("reservation", "name", true);
</script>

