Vue.use(VueMaterial.default)
new Vue({
	el:'#container',
	created: function() {
		this.fetch();
	},
	data:{
        NuevoPlaeholder:null,
        NuevoType:null,
        error:{"border":'1px solid red',"box-shadow":'0 0 5px 1px red'},
        agregar: false,
        inputs: [
		{"type" : 'text', "placeholder": 'Nombre', "value":null, "mostrar" : false, "validacion" : ''},
		{"type" : 'number', "placeholder": 'Celular',"value":null, "mostrar" : false, "validacion" : ''},
		{"type" : 'email', "placeholder": 'Correo', "value":null, "mostrar" : false, "validacion" : ''}]
    },

	methods:{
		aggInput: function () {
			if(this.NuevoPlaeholder && this.NuevoType){

				this.inputs.push({
					type: this.NuevoType,
					placeholder: this.NuevoPlaeholder,
					value:null,
					mostrar : false,
					validacion : ''
				}),
				this.NuevoPlaeholder = '',
				this.NuevoType = '';
			}else{
				alert('Complete los campos');
			}

		},
		delInput: function(indice) {
			this.inputs.splice(indice,1);
		},
		mostrando: function (indice){
			this.inputs[indice].mostrar = !this.inputs[indice].mostrar;
		},
		enviarDatos: function (){
			var data = JSON.stringify(this.inputs);
			this.$http.post("./forms/edit.json", {json: data}).then(function(response) {
				console.log(response);
				this.fetch();
			});
		},
		fetch: function() {
			this.$http.get("./forms.json").then(function(response) {
				if (!response.body.json) {
					this.inputs = [];
				} else {
					this.inputs = JSON.parse(response.body.json);
				}
				
			});
		},
		save: function() {
			this.enviarDatos();
		},
		validarText: function(indice,tipo){
			switch(tipo){
				case 'text':
					if(!this.inputs[indice].value.search(/^[a-zA-Z\s]*$/))
						this.inputs[indice].validacion = '';
					else{
						this.inputs[indice].validacion = this.error; 
					}
				break;
				case 'number':
					if(this.inputs[indice].value.search(/^[a-zA-Z\s]*$/))
						this.inputs[indice].validacion = '';
					else{
						this.inputs[indice].validacion = this.error; 
					}
				break;
			}
		}
	}

});