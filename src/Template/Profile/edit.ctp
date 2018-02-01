<?php
$this->assign('title', "Editar perfil");

?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDiFNld0ICiMfY9Kdpm_w37ksfF9xT0M4o"></script>
<?= $this->Html->css('edit_profile') ?>

    <div class="edit_profile mdl-grid" id="edit">

        <div class="mdl-cell mdl-cell--6-col">
            <h6>Foto de perfil</h6>
            <div>
                <img :src="'../'+profile_photo" style="border-radius: 100px; width: 200px; height: 200px; margin: auto;"/>
            </div>
            
                <label for="photo">
                        <p>
                            Cambiar foto
                        </p>
                </label>
            
            <?php echo $this->Form->input('photo', ['type' => 'file', "@change" => "setPhoto", "ref" => "profilePhoto", "label" => false, "style" => "visibility: hidden;"]); ?>
        </div>

        
        

        <div class="mdl-cell mdl-cell--6-col">
            <h6>Descripción del perfil</h6>
            <div class="mdl-textfield mdl-js-textfield">
                <textarea class="mdl-textfield__input" type="text" rows="6" id="desc" v-model="profile_data.description"></textarea>
                <label class="mdl-textfield__label" for="desc">Descripción del perfil</label>
            </div>
            <div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" @click="save()">
                Guardar
            </button>
            </div>
            
        </div>

        <div class="mdl-cell mdl-cell--6-col">
            <h6>Geolocalizacion</h6>
            

            <selector-map @locationUpdated="locationUpdated" :lat="profile_data.location.lat" :lon="profile_data.location.lng" style="width: 300px; height: 300px;">
            </selector-map>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" @click="save()">
                Guardar
            </button>
        </div>

        

        <div class="mdl-cell mdl-cell--6-col">
            <h6>Datos de contacto</h6>
            <div v-if="profile_data.contact && profile_data.contact.length > 0">
                <ul class="mdl-list">
                    <li class="mdl-list__item mdl-list__item--two-line" v-for="data in profile_data.contact">
                        <span class="mdl-list__item-primary-content">
                            <span>{{data.key}}</span>
                            <span class="mdl-list__item-sub-title">{{data.value}}</span>
                            
                        </span>
                        <a class="mdl-list__item-secondary-action" href="#" @click="removeContact(data.key)"><i class="material-icons">delete</i></a>
                    </li>
                </ul>
            </div>
            <div v-if="!profile_data.contact || !(profile_data.contact.length > 0)">
                <h6 style="color: gray">¡No existen datos de contacto!</h6>
            </div>
            <div>
                <h6>Agregar nuevo dato de contacto</h6>
                <div class="mdl-textfield mdl-js-textfield">
                    <input type="text" class="mdl-textfield__input" v-model.trim="formData.key">
                    <label class="mdl-textfield__label" for="text">Nombre</label>

                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input type="text" class="mdl-textfield__input" v-model.trim="formData.value">
                    <label class="mdl-textfield__label" for="text">Valor</label>

                </div>
                <div>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" @click="addContact()">
                        Agregar
                    </button>
                </div>
            </div>

        </div>


    </div>

    <?= $this->Html->script("edit_profile") ?>