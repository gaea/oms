		
		var tipoid_datastore = new Ext.data.GroupingStore({
			id: 'tipoId_datastore',
			proxy: new Ext.data.HttpProxy({
				url: 'tipo_identificacion/listarTipos',//getAbsoluteUrl('gestionar_cancion','listarCancion'), 
				method: 'POST',
				limit: 10,
				start: 0
			}),
			baseParams:{}, 
			reader: new Ext.data.JsonReader({
				root: 'results',
				totalProperty: 'total',
				id: 'id'
				},[ 
				{name: 'identificacion_codigo'},
				{name: 'identificacion_nombre'},
				{name: 'identificacion_descripcion'}
			]),
			sortInfo:{field: 'identificacion_nombre', direction: "ASC"}
		});
		tipoid_datastore.load();
	
		var comboTipoId = new Ext.form.ComboBox({
			xtype: 'combo',
			name: 'tipoId_combo',
			id: 'tipoId_combo',
			fieldLabel: 'Tipo id',
			width: 168,
			mode: 'local',
			store: tipoid_datastore,
			valueField: 'identificacion_codigo',
			displayField:'identificacion_nombre',
			typeAhead: true,
			triggerAction: 'all',
			allowBlank: false,
			forceSelection: true, 
			selectOnFocus: true,
			emptyText: ' [seleccione uno]'
		});	

		var registro_cliente_form_panel = new Ext.FormPanel({
			title:'Registro Cliente',
			border:true,
			height: 350,
			width: 300,
			bodyStyle:'padding: 10px',
			style: {
			  "margin":"50px auto"
			},
			defaults:{xtype:'textfield'},
			items:[
				{
					fieldLabel:'Nombre',
					name:'nombre_usuario',
					id:"nombre_usuario",
					allowBlank:false
				},
				{
					fieldLabel:'Apellido',
					name:'apellido_usuario',
					id:'apellido_usuario',
					allowBlank:false
				},
				comboTipoId,
				{
					fieldLabel:'No. identificacion',
					name:'idetificacion_usuario',
					id:'identificacion_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Direccion',
					name:'direccion_usuario',
					id:'direccion_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Telefono',
					name:'telefono_usuario',
					id:'telefono_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Correo-e',
					name:'email_usuario',
					id:'email_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Login',
					name:'login_usuario',
					id:"login_usuario"
				},
				{
					fieldLabel:'Password',
					inputType: 'password',
					name:'pass_usuario',
					id:'pass_usuario'
				}
			],
			buttonAlign: 'right',
			buttons:
			[
				{
					text:'Aceptar',
					id:'btn_aceptar',
					handler: fun_aceptar_registro
				},
				{
					text:'Cancelar',
					id:'btn_cancelar',
					handler: fun_cancelar_registro
				}
			],
			renderTo:'div_form_registro_cliente'
		});
		
		/**
		 * 
		 * FUNCIONES
		 * 
		 * */
		 
		function fun_aceptar_registro(){
			if(fun_verificarCampos()){
				subirDatos(
					registro_cliente_form_panel,
					'gestionar_cliente/registrar',//getAbsoluteUrl('gestionar_cancion','crearCancion'),//
					{
						nombre_persona: Ext.getCmp('nombre_usuario').getValue(),
						apellido_persona: Ext.getCmp('apellido_usuario').getValue(),
						id_tipo_identificacion: Ext.getCmp('tipoId_combo').getValue(),
						identificacion_persona: Ext.getCmp('identificacion_usuario').getValue(),
						direccion_persona: Ext.getCmp('direccion_usuario').getValue(),
						telefono_persona: Ext.getCmp('telefono_usuario').getValue(),
						email_persona: Ext.getCmp('email_usuario').getValue(),
						login_cliente: Ext.getCmp('login_usuario').getValue(),
						contrasena_cliente: Ext.getCmp('pass_usuario').getValue()
					},
					fun_login_cliente,
					function(){}
				);
			}
		}
		
		function fun_login_cliente(){
			subirDatos(
				registro_cliente_form_panel,
				'login/autenticar',//getAbsoluteUrl('login','autenticar'), //'login/autenticar',
				{
					login_usuario: Ext.getCmp('login_usuario').getValue(),
					password_usuario: Ext.getCmp('pass_usuario').getValue()
				
				},
				function(){
					window.location = 'interfaz_cliente';
				},
				function(){}
			);
		}
		
		function fun_cancelar_registro(){
			window.location = 'login';
		}
		
		function fun_verificarCampos(){
			var valido=true;
			return valido;
		}
		 
		 
	
	
