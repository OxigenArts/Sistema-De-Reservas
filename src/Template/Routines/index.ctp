<?php
$this->assign('title', "Horario");
echo $this->Html->script('routine');
?>

<div>
<div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-card mdl-shadow--2dp" style="width: 100%;">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Horarios agregados</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item">
                                        item
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
                            <h2 class="mdl-card__title-text">Agregar horario</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis pellentesque lacus eleifend lacinia...
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Agregar
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
</div>
