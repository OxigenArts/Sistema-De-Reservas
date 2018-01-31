<?= $this->Html->css('date') ?>
<dialog class="mdl-dialog">
    <h4 class="mdl-dialog__title">Allow data collection?</h4>
    <div class="mdl-dialog__content">
      <p>
        Allowing us to collect data will let us get you the information you want faster.
      </p>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="mdl-button">Agree</button>
      <button type="button" class="mdl-button close">Disagree</button>
    </div>
  </dialog>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="table">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Datos</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="date in tabledata">
                <td>{{date.id}}</td>
                <td>
                    <p v-for="(value, key) in date.json">
                        <span class="mdl-chip" :id="date.id+key">
                            <span class="mdl-chip__text">{{key}} ({{value}})</span>
                        </span>
                        
                    </p>
                </td>
                <td>
                    <p :class="date.status">
                        {{date.status}}
                    </p>
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

    <?= $this->Html->script('table') ?>
        <script>
            table.elname = "reservation";

        </script>

