<?php
$this->assign('title', "Mensajes de contacto");

?>
<?= $this->Html->css('date') ?>
    <div class="table-responsive">

        <table class="mdl-shadow--2dp table" style="width: 100%;" id="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="date in tabledata">
                
                    <td>{{date.json.name}}</td>
                    <td>{{date.json.email}}</td>
                    <td>{{date.json.phone}}</td>
                    <td>{{date.json.message}}</td>
                    <td>
                        <div>
                            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.delete('+date.id+')'">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <?= $this->Html->script('table') ?>
        <script>
            table.setElement("mesage", "json", true);
        </script>
