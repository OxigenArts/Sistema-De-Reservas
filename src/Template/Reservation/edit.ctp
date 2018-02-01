<?php

$this->assign('title', "Reservaciones");

?>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header" id="edit">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row" style="padding: 0;">
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="..">
                    <i class="material-icons">keyboard_arrow_left</i> Volver
                </a>
            </nav>
            <span class="mdl-layout-title">Editar reservacion</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link">
                    Estado: {{reservation_data.status}}
                </a>
                <a class="mdl-navigation__link">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" :onclick="'editreservation.accept()'">
                        <i class="material-icons" style="color: white;">done</i>
                    </button>

                </a>
                <a class="mdl-navigation__link">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" :onclick="'editreservation.dismiss()'">
                        <i class="material-icons" style="color: white;">clear</i>
                    </button>
                </a>
                <a class="mdl-navigation__link">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" :onclick="'editreservation.delete()'">
                        <i class="material-icons" style="color: white;">delete</i>
                    </button>
                </a>

            </nav>
        </div>
    </header>
    <main class="mdl-layout__content">
        <div class="page-content">

            <div class="mdl-grid" v-if="reservation_data.name">
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-card mdl-shadow--2dp" style="width: 100%;">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Datos personales</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">
                                <li class="mdl-list__item" v-for="(value, key) in reservation_data.name.data">
                                    <span class="mdl-list__item">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" v-model="reservation_data.name.data[key]">
                                            <label class="mdl-textfield__label" for="sample3">{{key}}</label>
                                        </div>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" :onclick="'editreservation.save()'">
                                Guardar
                            </a>
                        </div>
                    </div>

                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-card mdl-shadow--2dp" style="width: 100%;">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Datos de horario</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis pellentesque lacus eleifend lacinia...
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Get Started
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>
</div>
<?= $this->Html->script("edit_reservation") ?>
    <script>
        editreservation.setId(<?= $reservation->id ?>);
    </script>