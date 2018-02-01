<?php
$this->assign('title', "Llave de acceso");

?>
<?= $this->Html->css('date') ?>
    <div class="table-responsive">

        <table class="mdl-shadow--2dp table" style="width: 100%;" id="table">
            <thead>
                <tr>
                    <th>Llave de acceso</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="date in tabledata.apikey">
                
                    <td>{{date.api_key}}</td>

                    <td>
                    
                        
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" :onclick="'table.refresh()'">
                            <i class="material-icons">refresh</i>
                        </button>

                    </td>

                </tr>
            </tbody>
        </table>
    </div>


    <?= $this->Html->script('table') ?>
        <script>
            table.setElement("apikey", "api_key", false);
        </script>

