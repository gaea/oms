
	var cancion_adquirida_datastore = new Ext.data.GroupingStore({
		id: 'cancion_adquirida_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'programar_cancion/listarCancionadquirida',//getAbsoluteUrl('comprar_cancion','listarCanciondisponible'), 
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
			{name: 'cancion_adquirida_codigo'},
			{name: 'cancion_adquirida_nombre'},
			{name: 'cancion_adquirida_autor'},
			{name: 'cancion_adquirida_album'},
			{name: 'cancion_adquirida_fecha_de_publicacion'},
			{name: 'cancion_adquirida_duracion'},
			{name: 'cancion_adquirida_url'},
			{name: 'cancion_adquirida_habilitada'},
			{name: 'cancion_adquirida_precio'},
			{name: 'cancion_adquirida_ranking'}
	
		]),
		sortInfo: {field: 'cancion_adquirida_nombre', direction: "ASC"},
		groupField: 'cancion_adquirida_album'
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
			{ id: 'cancion_adquirida_nombre_col_id',  header: "Nombre",  dataIndex: 'cancion_adquirida_nombre'},
			{ header: "Autor", width: 100, dataIndex: 'cancion_adquirida_autor'},
			{ header: "Album", width: 180, dataIndex: 'cancion_adquirida_album'},
			//{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'cancion_adquirida_duracion'},
		]
	});
	
	var url_cancion = '';
	var codigo_cancion_adquirida = '';
	
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
					url_cancion = rec.get('cancion_adquirida_url');
					codigo_cancion_adquirida = rec.get('cancion_adquirida_codigo');
				}
			}
		}),
		autoExpandColumn: 'cancion_adquirida_nombre_col_id',
		autoExpandMin: 150,
		height: 385,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		tbar: [
			{
				xtype: 'textfield',
				id: 'cancion_adquirida_buscar_textfield'
			},
			{
				xtype: 'button',
				text: 'Buscar',
				handler: fun_cancion_adquirida_buscar,
				iconCls: 'buscar16'
			}
		],
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
		height: 513,
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
						//value: 0,
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
						//value: 0,
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
						//value: 0,
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
				text: 'Programar',
				handler: fun_programar_cancion_programar,
				id: 'programar_cancion_programar_boton',
				iconCls: 'crear16',
				tooltip: 'Pulse aqui para programar nuevas canciones'
			}/*,
			{	
				text: 'Actualizar',
				handler: fun_programar_cancion_actualizar,
				//id:'programar_cancion_programar_boton',
				iconCls: 'actualizar16',
				tooltip: 'Pulse aqui para actualizar los datos de las cunas'
			},
			{
				text: 'Cancelar',
				id: 'programar_cancion_cancelar_boton',
				handler: fun_programar_cancion_cancelar,
				iconCls: 'eliminar16',
				tooltip: 'Pulse aqu&iacute; para cancelar'
			}*/
		]	
	});

	var programacion_cancion_datastore = new Ext.data.GroupingStore({
		id: 'programacion_cancion_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'programar_cancion/listarProgramacioncancion',
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
			{name: 'programacion_cancion_codigo'},
			{name: 'programacion_cancion_nombre'},
			{name: 'programacion_cancion_fecha'},
			{name: 'programacion_cancion_duracion'},
			{name: 'programacion_cancion_url'},
			{name: 'programacion_cancion_inicio'}
		]),
		sortInfo: {field: 'programacion_cancion_inicio', direction: "DES"},
		groupField: 'programacion_cancion_fecha'
	});
	programacion_cancion_datastore.load();

	function fun_programacion_cancion_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_programacion_cancion" onClick="fun_programacion_cancion_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var programacion_cancion_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ id: 'imagen', header: "Play", width: 50, dataIndex: 'imagen', renderer: fun_programacion_cancion_ponericono},
			{ id: 'programacion_cancion_nombre_col_id',  header: "Nombre",  dataIndex: 'programacion_cancion_nombre'},
			{ header: "Duraci&oacute;n", width: 80,  dataIndex: 'programacion_cancion_duracion'},
			{ header: "Fecha", width: 80, dataIndex: 'programacion_cancion_fecha'},
			{ header: "Inicio", width: 80, dataIndex: 'programacion_cancion_inicio'},
		]
	});
	
	var programar_cancion_codigo_cancion = '';
	
	var programacion_cancion_gridpanel = new Ext.grid.GridPanel({
		id: 'programacion_cancion_gridpanel',
		title:'Programaci&oacute;n',
		columnWidth: '.5',
		stripeRows:true,
		style: {"margin-left": "10px"},
		frame: true,
		ds: programacion_cancion_datastore,
		cm: programacion_cancion_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					programar_cancion_codigo_cancion = rec.get('programacion_cancion_url');
					/*Ext.getCmp('programacion_cancion_formpanel').getForm().loadRecord(rec);
					Ext.getCmp('programar_cancion_programar_boton').setText('Nuevo');
					Ext.getCmp('programacion_cancion_descargar_boton').setDisabled(false);
					Ext.getCmp('programar_cancion_cancelar_boton').setDisabled(false);*/
				}
			}
		}),
		autoExpandColumn: 'programacion_cancion_nombre_col_id',
		autoExpandMin: 200,
		height: 513,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: programacion_cancion_datastore,
			displayInfo: true,
			displayMsg: 'Cunas {0} - {1} de {2}',
			emptyMsg: "No hay canciones programadas"
		}),
		view: new Ext.grid.GroupingView()
    });
	
	var programacion_cancion_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'programacion_cancion_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		tabTip :'Aqui puedes programar las canciones que hayas comprado',
		monitorResize:true,
		layout:'column',
		items: 
		[
			programacion_cancion_formpanel,
			programacion_cancion_gridpanel
		],
		renderTo:'div_form_programar_cancion'
	});

/***********************************FUNCIONES*****************************/

	function fun_programar_cancion_programar(){
		if(codigo_cancion_adquirida != ''){
			subirDatos(
				programacion_cancion_formpanel,
				'programar_cancion/programarCancion',//getAbsoluteUrl('programar_cancion','programarCancion'),
				{
					codigo_cancion_adquirida : codigo_cancion_adquirida
				},
				function(){
					programacion_cancion_datastore.reload(); 
				},
				function(){}
			);
		}
		else
		{
			mostrarMensajeRapido('Alerta!', 'Seleccione una canci&oacute;n, una fecha y una hora de inicio');
		}
	}
	
	function fun_cancion_adquirida_buscar(){
		if(Ext.getCmp('cancion_adquirida_buscar_textfield').getValue() != ''){
			cancion_adquirida_datastore.load({
				params: {
					buscar: Ext.getCmp('cancion_adquirida_buscar_textfield').getValue(),
					start: 0,
					limit: 10
				}
			});
		}
		else{
			mostrarMensajeRapido('Alerta!', 'Ingrese al menos una palabra');
		}
	}
	
	function fun_programacion_cancion_descargar(){
		if(programar_cancion_codigo_cancion != ''){
			var url = url_web+programar_cancion_codigo_cancion; 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}

