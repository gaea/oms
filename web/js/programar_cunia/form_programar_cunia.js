
	var cunia_adquirida_datastore = new Ext.data.GroupingStore({
		id: 'cunia_adquirida_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'programar_cunia/listarCuniaAdquirida',//getAbsoluteUrl('comprar_cancion','listarCanciondisponible'), 
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
			{name: 'cunia_adquirida_codigo'},
			{name: 'cunia_adquirida_nombre'},
			{name: 'cunia_adquirida_fecha_de_creacion'},
			{name: 'cunia_adquirida_duracion'},
			{name: 'cunia_adquirida_url'},
			{name: 'cunia_adquirida_precio'},
			{name: 'cunia_adquirida_habilitada'}
	
		]),
		sortInfo: {field: 'cunia_adquirida_nombre', direction: "ASC"}
	});
	cunia_adquirida_datastore.load();

	function can_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cunia" onClick="fun_cunia_adquirida_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var cunia_adquirida_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ header: "Play", width: 50, dataIndex: 'imagen', renderer: can_ponericono},
			{ id: 'cunia_adquirida_nombre_col_id',  header: "Nombre",  dataIndex: 'cunia_adquirida_nombre'},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'cunia_adquirida_duracion'},
			//{ header: "Precio", width: 80,  dataIndex: 'cunia_adquirida_precio', renderer: Ext.util.Format.usMoney}
			
		]
	});
	
	var url_cunia_adquirida = '';
	var codigo_cunia_adquirida = '';
	
	var programacion_cunia_cunias_grid = new Ext.grid.GridPanel({
		id: 'programacion_cunia_cunias_grid',
		title:'Cuñas adquiridas',
		//columnWidth: '.5',
		stripeRows:true,
		frame: true,
		ds: cunia_adquirida_datastore,
		cm: cunia_adquirida_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					url_cunia_adquirida = rec.get('cunia_adquirida_url');
					codigo_cunia_adquirida = rec.get('cunia_adquirida_codigo');
				}
			}
		}),
		autoExpandColumn: 'cunia_adquirida_nombre_col_id',
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
				id: 'cunia_adquirida_buscar_textfield'
			},
			{
				xtype: 'button',
				text: 'Buscar',
				handler: fun_cunia_adquirida_buscar,
				iconCls: 'buscar16'
			}
		],
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: cunia_adquirida_datastore,
			displayInfo: true,
			displayMsg: 'Cuñas {0} - {1} de {2}',
			emptyMsg: "No hay cuñas"
		}),
		view: new Ext.grid.GroupingView()
    });

	var programacion_cunia_formpanel = new Ext.FormPanel({
		title:'Crear una entrada a la programaci&oacute;n',
		columnWidth:'.5',
		height: 513,
		frame:true,
		id:'programacion_cunia_formpanel',
		fileUpload: true,
		bodyStyle: 'padding:10px',
		padding: 5,
		//defaults:{xtype:'textfield'},
		items:
		[
			{
				xtype:'datefield',
				fieldLabel: 'Fecha',
				id: 'programacion_cunia_fecha',
				name: 'programacion_cunia_fecha',
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
						name: 'programacion_cunia_hora',
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
						name: 'programacion_cunia_minuto',
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
						name: 'programacion_cunia_segundo',
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
			programacion_cunia_cunias_grid
		],
		buttons:
		[
			{	
				text: 'Programar',
				handler: fun_programar_cunia_programar,
				id: 'programar_cunia_programar_boton',
				iconCls: 'crear16',
				tooltip: 'Pulse aqui para programar nuevas cuñas'
			}
		]	
	});

	var programacion_cunia_datastore = new Ext.data.GroupingStore({
		id: 'programacion_cunia_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'programar_cunia/listarProgramacionCunia',
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
			{name: 'programacion_cunia_codigo'},
			{name: 'programacion_cunia_nombre'},
			{name: 'programacion_cunia_fecha'},
			{name: 'programacion_cunia_duracion'},
			{name: 'programacion_cunia_url'},
			{name: 'programacion_cunia_inicio'}
		]),
		sortInfo: {field: 'programacion_cunia_inicio', direction: "DES"},
		groupField: 'programacion_cunia_fecha'
	});
	programacion_cunia_datastore.load();

	function fun_programacion_cunia_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_programacion_cunia" onClick="fun_programacion_cunia_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var programacion_cunia_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ id: 'imagen', header: "Play", width: 50, dataIndex: 'imagen', renderer: fun_programacion_cunia_ponericono},
			{ id: 'programacion_cunia_nombre_col_id',  header: "Nombre",  dataIndex: 'programacion_cunia_nombre'},
			{ header: "Duraci&oacute;n", width: 80,  dataIndex: 'programacion_cunia_duracion'},
			{ header: "Fecha", width: 80, dataIndex: 'programacion_cunia_fecha'},
			{ header: "Inicio", width: 80, dataIndex: 'programacion_cunia_inicio'},
		]
	});
	
	var programar_cunia_codigo_cunia = '';
	
	var programacion_cunia_gridpanel = new Ext.grid.GridPanel({
		id: 'programacion_cunia_gridpanel',
		title:'Programaci&oacute;n',
		columnWidth: '.5',
		stripeRows:true,
		style: {"margin-left": "10px"},
		frame: true,
		ds: programacion_cunia_datastore,
		cm: programacion_cunia_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					programar_cunia_codigo_cunia = rec.get('programacion_cunia_url');
				}
			}
		}),
		autoExpandColumn: 'programacion_cunia_nombre_col_id',
		autoExpandMin: 200,
		height: 513,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: programacion_cunia_datastore,
			displayInfo: true,
			displayMsg: 'Cuñas {0} - {1} de {2}',
			emptyMsg: "No hay cuñas programadas"
		}),
		view: new Ext.grid.GroupingView()
    });
	
	var programacion_cunia_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'programacion_cunia_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		tabTip :'Aqui puedes programar las cuñas que hayas subido',
		monitorResize:true,
		layout:'column',
		items: 
		[
			programacion_cunia_formpanel,
			programacion_cunia_gridpanel
		],
		renderTo:'div_form_programar_cunia'
	});



/***********************************FUNCIONES*****************************/

	function fun_programar_cunia_programar(){
		if(codigo_cunia_adquirida != ''){
			subirDatos(
				programacion_cunia_formpanel,
				'programar_cunia/programarCunia',//getAbsoluteUrl('programar_cancion','programarCancion'),
				{
					codigo_cunia_adquirida : codigo_cunia_adquirida
				},
				function(){
					programacion_cunia_datastore.reload(); 
				},
				function(){}
			);
		}
		else
		{
			mostrarMensajeRapido('Alerta!', 'Seleccione una cuña, una fecha y una hora de inicio');
		}
	}
	
	function fun_cunia_adquirida_buscar(){
		if(Ext.getCmp('cunia_adquirida_buscar_textfield').getValue() != ''){
			cunia_adquirida_datastore.load({
				params: {
					buscar: Ext.getCmp('cunia_adquirida_buscar_textfield').getValue(),
					start: 0,
					limit: 10
				}
			});
		}
		else{
			mostrarMensajeRapido('Alerta!', 'Ingrese al menos una palabra');
		}
	}
	
	function fun_programacion_cunia_descargar(){
		if(programar_cunia_codigo_cunia != ''){
			var url = url_web+programar_cunia_codigo_cunia; 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una cuña a descargar");
		}
	}
	
	function fun_cunia_adquirida_descargar(){
		if(url_cunia_adquirida != ''){
			var url = url_web+url_cunia_adquirida; 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una cuña a descargar");
		}
	}

