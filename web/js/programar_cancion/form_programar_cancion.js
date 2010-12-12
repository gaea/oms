
	var cancion_adquirida_datastore = new Ext.data.GroupingStore({
		id: 'cancion_adquirida_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'comprar_cancion/listarCancionadquirida',//getAbsoluteUrl('comprar_cancion','listarCanciondisponible'), 
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
			{name: 'can_codigo'},
			{name: 'can_nombre'},
			{name: 'can_autor'},
			{name: 'can_album'},
			{name: 'can_fecha_de_publicacion'},
			{name: 'can_duracion'},
			{name: 'can_url'},
			{name: 'can_habilitada'},
			{name: 'can_precio'},
			{name: 'can_ranking'}
	
		]),
		sortInfo:{field: 'can_nombre', direction: "ASC"},
		groupField:'can_album'
	});
	cancion_adquirida_datastore.load();

	function can_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cancion" onClick="fun_can_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var cancion_adquirida_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ header: "Play", width: 50, dataIndex: 'imagen', renderer: can_ponericono},
			{ id: 'can_ad_nombre_col_id',  header: "Nombre",  dataIndex: 'can_nombre'},
			{ header: "Autor", width: 100, dataIndex: 'can_autor'},
			{ header: "Album", width: 180, dataIndex: 'can_album'},
			//{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'can_duracion'},
		]
	});
	
	var programacion_cancion_canciones_grid = new Ext.grid.GridPanel({
		id: 'programacion_cancion_canciones_grid',
		title:'Canciones adquiridas',
		//columnWidth: '.5',
		stripeRows:true,
		frame: true,
		ds: cancion_adquirida_datastore,
		cm: cancion_adquirida_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					url_cancion = rec.get('can_url');		
				}
			}
		}),
		autoExpandColumn: 'can_ad_nombre_col_id',
		autoExpandMin: 150,
		height: 270,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: cancion_adquirida_datastore,
			displayInfo: true,
			displayMsg: 'Canciones {0} - {1} de {2}',
			emptyMsg: "No hay canciones"
		}),
		view: new Ext.grid.GroupingView()
    });

	var programacion_cancion_formpanel = new Ext.FormPanel({
		title:'Crear una entrada a la programaci&oacute;n',
		columnWidth:'.5',
		height: 413,
		frame:true,
		id:'programacion_cancion_formpanel',
		fileUpload: true,
		bodyStyle: 'padding:10px',
		padding: 5,
		//defaults:{xtype:'textfield'},
		items:
		[
			{
				xtype:'datefield',
				fieldLabel: 'Fecha',
				id: 'programacion_cancion_fecha',
				name: 'programacion_cancion_fecha',
				allowBlank: false,
				format: 'Y-m-d',
				width: 200,
			},
			{
				xtype: 'compositefield',
                fieldLabel: 'Inicio',
				msgTarget: 'under',
				items: [
					{
						xtype: 'spinnerfield',
						name: 'programacion_cancion_hora',
						minValue: 0,
						maxValue: 23,
						incrementValue: 1,
						alternateIncrementValue: 2,
						accelerate: true,
						width: 50, 
						allowBlank: false
					},
					{xtype: 'displayfield', value: ':'},
					{
						xtype: 'spinnerfield',
						name: 'programacion_cancion_minuto',
						minValue: 0,
						maxValue: 59,
						incrementValue: 1,
						alternateIncrementValue: 2,
						accelerate: true,
						width: 50, 
						allowBlank: false
					},
					{xtype: 'displayfield', value: ':'},
					{
						xtype: 'spinnerfield',
						name: 'programacion_cancion_segundo',
						minValue: 0,
						maxValue: 59,
						incrementValue: 1,
						alternateIncrementValue: 2,
						accelerate: true,
						width: 50, 
						allowBlank: false
					}
				]
			},
			programacion_cancion_canciones_grid
		],
		buttons:
		[
			{	
				text: 'Guardar',
				handler: fun_cunia_crear,
				id: 'cunia_crear_boton',
				iconCls: 'crear16',
				tooltip: 'Pulse aqui para guardar nuevas cunas'
			},
			{	
				text: 'Actualizar',
				handler: fun_cunia_actualizar,
				//id:'cunia_crear_boton',
				iconCls: 'actualizar16',
				tooltip: 'Pulse aqui para actualizar los datos de las cunas'
			},
			{
				text: 'Cancelar',
				id: 'cunia_cancelar_boton',
				handler: fun_cunia_cancelar,
				iconCls: 'eliminar16',
				tooltip: 'Pulse aqu&iacute; para cancelar'
			},
			{
				text: 'Descargar',
				disabled: true,
				id: 'cunia_descargar_boton',
				handler: fun_cunia_descargar,
				iconCls: 'next16',
				tooltip: 'Seleccione una cuña y pulse aqu&iacute; para descargarla'
			}
		]	
	});

	var cunia_datastore = new Ext.data.GroupingStore({
		id: 'cunia_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'subir_cunia/listarCunias',
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
			{name: 'cunia_codigo'},
			{name: 'cunia_nombre'},
			{name: 'cunia_fecha_creacion'},
			{name: 'cunia_duracion'},
			{name: 'cunia_url'},
			{name: 'cunia_habilitada'}
		]),
		sortInfo:{field: 'cunia_nombre', direction: "ASC"}//,
		//groupField: 'cunia_fecha_creacion'
	});
	cunia_datastore.load();

	function cunia_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cunia" onClick="fun_cunia_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var cunia_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ id: 'imagen', header: "Play", width: 50, dataIndex: 'imagen', renderer: cunia_ponericono},
			{ id: 'cunia_nombre_col_id',  header: "Nombre",  dataIndex: 'cunia_nombre'},
			{ header: "Duraci&oacute;n", width: 80,  dataIndex: 'cunia_duracion'},
			{ header: "Fecha", width: 80},
			{ header: "Inicio", width: 80},
		]
	});
	
	var codigo_cunia_actualizar = '';
	
	var cunia_gridpanel = new Ext.grid.GridPanel({
		id: 'cunia_gridpanel',
		title:'Programaci&oacute;n',
		columnWidth: '.5',
		stripeRows:true,
		style: {"margin-left": "10px"},
		frame: true,
		ds: cunia_datastore,
		cm: cunia_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					Ext.getCmp('programacion_cancion_formpanel').getForm().loadRecord(rec);
					Ext.getCmp('cunia_crear_boton').setText('Nuevo');
					Ext.getCmp('cunia_descargar_boton').setDisabled(false);
					Ext.getCmp('cunia_cancelar_boton').setDisabled(false);
					codigo_cunia_actualizar = rec.get('cunia_codigo');
				}
			}
		}),
		autoExpandColumn: 'cunia_nombre_col_id',
		autoExpandMin: 200,
		height: 413,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: cunia_datastore,
			displayInfo: true,
			displayMsg: 'Cunas {0} - {1} de {2}',
			emptyMsg: "No hay cunas"
		}),
		view: new Ext.grid.GroupingView()
    });
	
	var cunia_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'cunia_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		tabTip :'Aqui puedes ver, agregar , cancelar y descargar cunas comerciales',
		monitorResize:true,
		layout:'column',
		items: 
		[
			programacion_cancion_formpanel,
			cunia_gridpanel
		],
		renderTo:'div_form_programar_cancion'
	});

/***********************************FUNCIONES*****************************/

	function fun_cunia_crear(){
		if(Ext.getCmp('cunia_crear_boton').getText()=='Nuevo'){
			programacion_cancion_formpanel.getForm().reset();
			Ext.getCmp('cunia_crear_boton').setText('Guardar');
			Ext.getCmp('cunia_descargar_boton').setDisabled(true);
			Ext.getCmp('cunia_cancelar_boton').setText('Cancelar');
			Ext.getCmp('cunia_cancelar_boton').setDisabled(false);
		}

		if(Ext.getCmp('cunia_crear_boton').getText()=='Guardar'){ 
			var verificacion =fun_can_verificarCamposDocumento();
	  
	 		if(verificacion){
				subirDatos(
					programacion_cancion_formpanel,
					getAbsoluteUrl('subir_cunia','crearCunia'),
					{},
					function(){
						Ext.getCmp('cunia_crear_boton').setText('Nuevo');
						//Ext.getCmp('cunia_cancelar_boton').setText('Eliminar');
						Ext.getCmp('cunia_descargar_boton').setDisabled(false);
						cunia_datastore.reload(); 
					},
					function(){}
				);
			}
		}
	}
	
	function fun_cunia_actualizar(){
		if(codigo_cunia_actualizar != ''){ 
			var verificacion = fun_can_verificarCamposDocumento();
	 		if(verificacion){
				subirDatos(
					programacion_cancion_formpanel,
					getAbsoluteUrl('subir_cunia','actualizarCunia'),
					{codigo_cunia: codigo_cunia_actualizar},
					function(){
						Ext.getCmp('cunia_crear_boton').setText('Nuevo');
						//Ext.getCmp('cunia_cancelar_boton').setText('Eliminar');
						Ext.getCmp('cunia_descargar_boton').setDisabled(false);
						cunia_datastore.reload(); 
					},
					function(){}
				);
			}
		}
		else{
			mostrarMensajeRapido('Alerta!', 'Seleccione una canci&oacute;n');
		}
	}

	function fun_cunia_descargar(){
		if(Ext.getCmp('cunia_url').getValue()!=''){
			//alert(Ext.getCmp('cunia_url').getValue());
			var url = url_web+Ext.getCmp('cunia_url').getValue(); 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}
    
	function fun_cunia_cancelar(){
		if(Ext.getCmp('cunia_cancelar_boton').getText()=='Cancelar'){
		    Ext.getCmp('cunia_crear_boton').setText('Nuevo');
		    Ext.getCmp('cunia_descargar_boton').setDisabled(false);
		}
	}

	function fun_can_verificarCamposDocumento(){
		var valido=true;
		return valido;
	}
