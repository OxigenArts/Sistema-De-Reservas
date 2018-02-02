<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Form[]|\Cake\Collection\CollectionInterface $forms
 */
?>
<?= $this->Html->css('formulario') ?>
<?= $this->Html->css('vue-material.min') ?>
<?= $this->Html->css('vue-material.theme') ?>

<div id="container" class="container-fluid p-0 m-0 main">
		<div class="header">

			<md-toolbar>
		      <h3 class="md-title" style="flex: 1">Campos requeridos</h3>
		      <md-button class="md-icon-button" @click="agregar = true">
		        <md-icon class="md-default">add</md-icon>
		      </md-button>
              <md-button class="md-icon-button" @click="save">
		        <md-icon class="md-default">save</md-icon>
		      </md-button>
		    </md-toolbar>

		</div>

		<div class="listCampos">
			<ul class="ulCampos">
				<li class="itemCampos" v-for="(input,index) in inputs">
					<input class="form-control" v-bind:style="input.validacion" :placeholder="input.placeholder" :type="input.type" v-model="input.value" @input="validarText(index,input.type)">

					<div v-show="input.mostrar">
						<md-field class="edita">
					      <label>Editando</label>
					      <md-input v-model="input.placeholder"></md-input>
					    </md-field>

					    <div class="md-layout md-gutter">
						      <div class="md-layout-item">
						        <md-field class="selec">
						          <label for="type">Tipo de dato</label>
						          <md-select v-model="input.type" name="type" id="type">
						            <md-option value="text">Texto</md-option>
						            <md-option value="number">Numerico</md-option>
						            <md-option value="email">Correo</md-option>
						        </md-field>
						   	 </div>
						   	 <md-button class="md-primary botonCerrar" @click="input.mostrar = false">
					      	Cerrar
					      </md-button>
						</div>

					</div>

			        <div class="botones" v-show="!input.mostrar">
			        	<md-button class="md-primary md-raised md-list-action" @click="mostrando(index)" >
				          <!-- <md-icon class="-">create</md-icon> -->
				          Editar
				        </md-button>
				        <md-button class="md-primary md-raised md-list-action" @click="delInput(index)" style="background-color: red">
				          <!-- <md-icon class="md-primary">cancel</md-icon> -->
				          Eliminar
				        </md-button>
			        </div>
				</li>
			</ul>
		</div>

		<md-dialog :md-active.sync="agregar">
			<md-dialog-title>Agrega un nuevo campo</md-dialog-title>
			<div class="nuevoInput">

				<input  class="form-control" type="text" v-model="NuevoPlaeholder" placeholder="Nombre*" v-on:keyup.enter='aggInput'>
				
				<div class="md-layout md-gutter">
			      <div class="md-layout-item">
			        <md-field style="z-index:9999">
			          <label for="type">Tipo de dato*</label>
			          <md-select v-model="NuevoType" name="type" id="type">
			            <md-option value="text">Texto</md-option>
			            <md-option value="number">Numerico</md-option>
			            <md-option value="email">Correo</md-option>
			        </md-field>
			   	 </div>
				</div>

				<md-button class="md-primary md-raised" @click="aggInput">Agregar</md-button>

			<md-dialog-actions>
				<md-button class="md-primary boton" @click="agregar = false">Cerrar</md-button>
			</md-dialog-actions>
		</md-dialog>

		

	</div>


<?= $this->Html->script('vue-material.min') ?>
<?= $this->Html->script('formulario') ?>
