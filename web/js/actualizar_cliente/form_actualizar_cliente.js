		var actual_cliente_datastore = new Ext.data.GroupingStore({
		id: 'actual_cliente_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'login/consultarCliente',
			method: 'POST',
			limit: 10,
			start: 0
		}),
		baseParams:{}, 
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'id_reader'
			},[ 
			{name: 'persona_codigo'},
			{name: 'persona_nombre'},
			{name: 'persona_apellido'},
			{name: 'identificacion_codigo'},
			{name: 'identificacion_nombre'},
			{name: 'persona_identificacion'},
			{name: 'persona_direccion'},
			{name: 'persona_telefono'},
			{name: 'persona_email'},
			{name: 'usuario_codigo'},
			{name: 'usuario_nombre'},
			{name: 'usuario_contrasena'}
		]),
		sortInfo:{field: 'persona_nombre', direction: "ASC"}
	});
	actual_cliente_datastore.load();
	
	var tipoid_datastore = new Ext.data.GroupingStore({
		id: 'tipoId_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'tipo_identificacion/listarTipos',
			method: 'POST',
			limit: 10,
			start: 0
		}),
		baseParams:{}, 
			reader: new Ext.data.JsonReader({
				root: 'results',
				totalProperty: 'total',
				id: 'id'
			},
			[ 
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
		
	var gestion_cliente_formpanel = new Ext.FormPanel({
		title:'Datos del usaurio cliente',
		columnWidth:'.4',
		height: 400,
		frame:true,
		id:'gestion_cliente_formpanel',
		bodyStyle: 'padding:10px',
		defaults:{xtype:'textfield',anchor:'100%'},
		items:[
			{
				fieldLabel:'Nombre',
				name:'persona_nombre',
				id:"persona_nombre",
				allowBlank:false
			},
			{
				fieldLabel:'Apellido',
				name:'persona_apellido',
				id:'persona_apellido',
				allowBlank:false
			},
			comboTipoId,
			{
				fieldLabel:'No. identificacion',
				name:'persona_identificacion',
				id:'persona_identificacion',
				allowBlank:false
			},
			{
				fieldLabel:'Direccion',
				name:'persona_direccion',
				id:'persona_direccion',
				allowBlank:false
			},
			{
				fieldLabel:'Telefono',
				name:'persona_telefono',
				id:'persona_telefono',
				allowBlank:false
			},
			{
				fieldLabel:'Correo-e',
				name:'persona_email',
				id:'persona_email',
				allowBlank:false
			},
			{
				fieldLabel:'Login',
				name:'usuario_nombre',
				id:"usuario_nombre",
				disabled:true
			},
			{
				fieldLabel:'Password',
				inputType: 'password',
				name:'usuario_contrasena',
				id:'usuario_contrasena'
			}
		],
		buttons:
		[
			{
				text: 'Actualizar',
				id: 'btn_actualizar_cliente',
				handler: fun_actualizar_cliente
			},
			{
				text: 'Cancelar',
				id: 'btn_cancelar_actualizacion',
				disabled: true,
				handler: fun_cancelar_actualizacion
			}
		],
		renderTo:'div_form_actualizar_cliente'
	});
	

	/*
	 * #######################################################################
	 * #############################  FUNCIONES  #############################  
	 * #######################################################################
	 * */
	 
	 
	 function fun_actualizar_cliente(){
		if(Ext.getCmp('btn_actualizar_cliente').getText()=='Actualizar'){
			var cliente_rec = actual_cliente_datastore.getAt(0);
			
			Ext.getCmp('persona_nombre').setValue(cliente_rec.get('persona_nombre'));
			Ext.getCmp('persona_apellido').setValue(cliente_rec.get('persona_apellido'));
			Ext.getCmp('tipoId_combo').setValue(cliente_rec.get('identificacion_codigo'));
			Ext.getCmp('persona_identificacion').setValue(cliente_rec.get('persona_identificacion'));
			Ext.getCmp('persona_direccion').setValue(cliente_rec.get('persona_direccion'));
			Ext.getCmp('persona_telefono').setValue(cliente_rec.get('persona_telefono'));
			Ext.getCmp('persona_email').setValue(cliente_rec.get('persona_email'));
			Ext.getCmp('usuario_nombre').setValue(cliente_rec.get('usuario_nombre'));
			Ext.getCmp('usuario_contrasena').setValue(cliente_rec.get('usuario_contrasena'));
			
			Ext.getCmp('btn_cancelar_actualizacion').setDisabled(false);
			Ext.getCmp('btn_actualizar_cliente').setText('Guardar');
		}
		else if(Ext.getCmp('btn_actualizar_cliente').getText()=='Guardar'){
			if(fun_verificarCampos()){
				
				subirDatos(
					gestion_cliente_formpanel,
					'gestionar_cliente/actualizar',
					{
						nombre_persona: Ext.getCmp('persona_nombre').getValue(),
						apellido_persona: Ext.getCmp('persona_apellido').getValue(),
						id_tipo_identificacion: Ext.getCmp('tipoId_combo').getValue(),
						identificacion_persona: Ext.getCmp('persona_identificacion').getValue(),
						direccion_persona: Ext.getCmp('persona_direccion').getValue(),
						telefono_persona: Ext.getCmp('persona_telefono').getValue(),
						email_persona: Ext.getCmp('persona_email').getValue(),
						login_cliente: Ext.getCmp('usuario_nombre').getValue(),
						contrasena_cliente: Ext.getCmp('usuario_contrasena').getValue()
					},
					function(){
						fun_cancelar_actualizacion();
						actual_cliente_datastore.reload();
					},
					function(){}
				);
				
			}
		}
	}
	
	function fun_cancelar_actualizacion(){
		gestion_cliente_formpanel.getForm().reset();
		Ext.getCmp('btn_cancelar_actualizacion').setDisabled(true);
		Ext.getCmp('btn_actualizar_cliente').setText('Actualizar');
		//Ext.getCmp('usuario_nombre').setDisabled(false);
		//fun_desabilitarCampos(false);
	}
	
	function fun_verificarCampos(){
		return true;
	}
