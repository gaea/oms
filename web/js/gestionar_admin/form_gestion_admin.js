	
	var actual_admin_datastore = new Ext.data.GroupingStore({
		id: 'actual_admin_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'login/consultarAdmin',
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
	actual_admin_datastore.load();
	
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
		
	var gestion_admin_formpanel = new Ext.FormPanel({
		title:'Datos del usaurio administrador',
		columnWidth:'.4',
		height: 400,
		frame:true,
		id:'gestion_admin_formpanel',
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
				id:"usuario_nombre"
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
				id: 'btn_actualizar_admin',
				handler: fun_actualizar_admin
			},
			{	
				text: 'Crear',
				id: 'btn_crear_admin',
				handler: fun_crear_admin
			},
			{	
				text: 'Eliminar',
				id: 'btn_eliminar_admin',
				handler: fun_eliminar_admin
				
			},
			{	
				text: 'Cancelar',
				id: 'btn_cancelar',
				disabled: true,
				handler: fun_cancelar
			}
		]	
	});
	
	var admin_datastore = new Ext.data.GroupingStore({
		id: 'admin_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'gestionar_admin/listar',
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
	admin_datastore.load();
 	
	var admin_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'grid_persona_codigo', header: "Codigo Persona", dataIndex: 'persona_codigo', hidden: true},
			{id: 'grid_persona_nombre', header: "Nombre", width: 80, dataIndex: 'persona_nombre'},
			{id: 'grid_persona_apellido', header: "Apellido", width: 80, dataIndex: 'persona_apellido'},
			{id: 'grid_identificacion_codigo', header: "Codigo Identificacion", dataIndex: 'identificacion_codigo', hidden: true},
			{id: 'grid_identificacion_nombre', header: "Tipo Id", width: 80, dataIndex: 'identificacion_nombre'},
			{id: 'grid_persona_identificacion', header: "Identificacion", width: 80, dataIndex: 'persona_identificacion'},
			{id: 'grid_persona_direccion', header: "Direccion", width: 80, dataIndex: 'persona_direccion'},
			{id: 'grid_persona_telefono', header: "Telefono", width: 80, dataIndex: 'persona_telefono'},
			{id: 'grid_persona_email', header: "Correo-e", width: 80, dataIndex: 'persona_email'},
			{id: 'grid_usuario_codigo', header: "Codigo Usuario", dataIndex: 'usuario_codigo', hidden: true},
			{id: 'grid_usuario_nombre', header: "Usuario", width: 80, dataIndex: 'usuario_nombre'},
			{id: 'grid_usuario_contrasena', header: "Contrasena Usuario", dataIndex: 'usuario_contrasena', hidden: true},
		]
	});
	
	var codigo_usuario = '';
	
	var admin_gridpanel = new Ext.grid.GridPanel({
		id: 'admin_gridpanel',
		title:'Administradores',
		columnWidth: '.6',
		stripeRows:true,
		style: {"margin-left": "10px"},
		frame: true,
		ds: admin_datastore,
		cm: admin_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					gestion_admin_formpanel.getForm().reset();
					gestion_admin_formpanel.getForm().loadRecord(rec);
					comboTipoId.setValue(rec.data.identificacion_nombre);
					codigo_usuario = rec.get('usuario_codigo');
				}
			}
		}),
		autoExpandColumn: 'grid_persona_nombre',
		autoExpandMin: 200,
		height: 413,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: admin_datastore,
			displayInfo: true,
			displayMsg: 'Administradores {0} - {1} de {2}',
			emptyMsg: "No hay administradores"
		}),
		view: new Ext.grid.GroupingView()
    });
	
	var admin_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'admin_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		tabTip :'Aqui puedes ver, crear y eliminar administradores',
		monitorResize:true,
		layout:'column',
		items: 
		[
			admin_gridpanel,
			gestion_admin_formpanel
		],
		renderTo:'div_form_gestion_admin'
	});
	
	
	/*
	 * #######################################################################
	 * #############################  FUNCIONES  #############################  
	 * #######################################################################
	 * */

	function fun_crear_admin(){
		
		if(Ext.getCmp('btn_crear_admin').getText()=='Crear'){
			gestion_admin_formpanel.getForm().reset();
			Ext.getCmp('btn_crear_admin').setText('Guardar');
			Ext.getCmp('btn_eliminar_admin').setDisabled(true);
			Ext.getCmp('btn_actualizar_admin').setDisabled(true);
			admin_gridpanel.disable(true);
			Ext.getCmp('btn_cancelar').setDisabled(false);
		}
		else if(Ext.getCmp('btn_crear_admin').getText()=='Guardar'){
			
	 		if(fun_verificarCampos()){
				
				subirDatos(
					gestion_admin_formpanel,
					'gestionar_admin/crear',
					{
						nombre_persona: Ext.getCmp('persona_nombre').getValue(),
						apellido_persona: Ext.getCmp('persona_apellido').getValue(),
						id_tipo_identificacion: Ext.getCmp('tipoId_combo').getValue(),
						identificacion_persona: Ext.getCmp('persona_identificacion').getValue(),
						direccion_persona: Ext.getCmp('persona_direccion').getValue(),
						telefono_persona: Ext.getCmp('persona_telefono').getValue(),
						email_persona: Ext.getCmp('persona_email').getValue(),
						login_admin: Ext.getCmp('usuario_nombre').getValue(),
						contrasena_admin: Ext.getCmp('usuario_contrasena').getValue()
					},
					function(){
						fun_cancelar();
						admin_datastore.reload();
					},
					function(){}
				);
				
			}
		}
	}
	
	function fun_eliminar_admin(){
		if(Ext.getCmp('btn_eliminar_admin').getText()=='Eliminar'){
			gestion_admin_formpanel.getForm().reset();
			fun_desabilitarCampos(true);
			Ext.getCmp('btn_crear_admin').setDisabled(true);
			Ext.getCmp('btn_actualizar_admin').setDisabled(true);
			Ext.getCmp('btn_eliminar_admin').setText('Aceptar');
			Ext.getCmp('btn_cancelar').setDisabled(false);
		}
		else if(Ext.getCmp('btn_eliminar_admin').getText()=='Aceptar'){
			var admin_rec = actual_admin_datastore.getAt(0);
			
			if(fun_verificarCampos()){
				
				if(admin_rec.get('usuario_nombre')!=Ext.getCmp('usuario_nombre').getValue())
				{
					subirDatos(
						gestion_admin_formpanel,
						'gestionar_admin/deshabilitar',
						{
							login_admin: Ext.getCmp('usuario_nombre').getValue()
						},
						function(){
							fun_cancelar();
							admin_datastore.reload();
						},
						function(){}
					);
				}
				else
				{
					Ext.Msg.show({
						title:'Advertencia',
						msg: 'No se puede eliminar el mismo usuairo autenticado',
						buttons: Ext.Msg.OK,
						animEl: 'elId',
						modal: true,
						width: 500,
						icon: Ext.MessageBox.WARNING
					});
				}
			}
		}
	}
	
	function fun_actualizar_admin(){
		if(Ext.getCmp('btn_actualizar_admin').getText()=='Actualizar'){
			var admin_rec = actual_admin_datastore.getAt(0);
			
			Ext.getCmp('persona_nombre').setValue(admin_rec.get('persona_nombre'));
			Ext.getCmp('persona_apellido').setValue(admin_rec.get('persona_apellido'));
			Ext.getCmp('tipoId_combo').setValue(admin_rec.get('identificacion_codigo'));
			Ext.getCmp('persona_identificacion').setValue(admin_rec.get('persona_identificacion'));
			Ext.getCmp('persona_direccion').setValue(admin_rec.get('persona_direccion'));
			Ext.getCmp('persona_telefono').setValue(admin_rec.get('persona_telefono'));
			Ext.getCmp('persona_email').setValue(admin_rec.get('persona_email'));
			Ext.getCmp('usuario_nombre').setValue(admin_rec.get('usuario_nombre'));
			Ext.getCmp('usuario_contrasena').setValue(admin_rec.get('usuario_contrasena'));
			
			Ext.getCmp('btn_eliminar_admin').setDisabled(true);
			Ext.getCmp('btn_crear_admin').setDisabled(true);
			Ext.getCmp('btn_cancelar').setDisabled(false);
			admin_gridpanel.disable(true);
			Ext.getCmp('usuario_nombre').setDisabled(true);
			Ext.getCmp('btn_actualizar_admin').setText('Guardar');
		}
		else if(Ext.getCmp('btn_actualizar_admin').getText()=='Guardar'){
			if(fun_verificarCampos()){
				
				subirDatos(
					gestion_admin_formpanel,
					'gestionar_admin/actualizar',
					{
						nombre_persona: Ext.getCmp('persona_nombre').getValue(),
						apellido_persona: Ext.getCmp('persona_apellido').getValue(),
						id_tipo_identificacion: Ext.getCmp('tipoId_combo').getValue(),
						identificacion_persona: Ext.getCmp('persona_identificacion').getValue(),
						direccion_persona: Ext.getCmp('persona_direccion').getValue(),
						telefono_persona: Ext.getCmp('persona_telefono').getValue(),
						email_persona: Ext.getCmp('persona_email').getValue(),
						login_admin: Ext.getCmp('usuario_nombre').getValue(),
						contrasena_admin: Ext.getCmp('usuario_contrasena').getValue()
					},
					function(){
						fun_cancelar();
						admin_datastore.reload();
						actual_admin_datastore.reload();
					},
					function(){}
				);
				
			}
		}
	}
	
	function fun_cancelar(){
		gestion_admin_formpanel.getForm().reset();
		Ext.getCmp('btn_crear_admin').setText('Crear');
		Ext.getCmp('btn_eliminar_admin').setText('Eliminar');
		Ext.getCmp('btn_actualizar_admin').setText('Actualizar');
		Ext.getCmp('btn_eliminar_admin').setDisabled(false);
		Ext.getCmp('btn_crear_admin').setDisabled(false);
		Ext.getCmp('btn_cancelar').setDisabled(true);
		Ext.getCmp('btn_actualizar_admin').setDisabled(false);
		admin_gridpanel.enable(true);
		Ext.getCmp('usuario_nombre').setDisabled(false);
		fun_desabilitarCampos(false);
	}
	
	function fun_verificarCampos(){
		return true;
	}
	
	function fun_desabilitarCampos( $valor ){
		Ext.getCmp('persona_nombre').setDisabled($valor);
		Ext.getCmp('persona_apellido').setDisabled($valor);
		Ext.getCmp('tipoId_combo').setDisabled($valor);
		Ext.getCmp('persona_identificacion').setDisabled($valor);
		Ext.getCmp('persona_direccion').setDisabled($valor);
		Ext.getCmp('persona_telefono').setDisabled($valor);
		Ext.getCmp('persona_email').setDisabled($valor);
		Ext.getCmp('usuario_nombre').setDisabled($valor);
		Ext.getCmp('usuario_contrasena').setDisabled($valor);
	}
