	
	var reportes_clientes_datastore = new Ext.data.GroupingStore({
		id: 'reportes_clientes_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'reportes/listarClientes',//getAbsoluteUrl('gestionar_cancion','listarCancion'), 
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
			{name: 'codigo'},
			{name: 'usuario'},
			{name: 'nombre'},
			{name: 'apellido'},
			{name: 'identificacion'},
			{name: 'tipo_identificacion'},
			{name: 'direccion'},
			{name: 'telefono'},
			{name: 'e_mail'},
			{name: 'habilitado'}
	
		]),
		sortInfo:{field: 'usuario', direction: "ASC"}
	});
	reportes_clientes_datastore.load();
 	
	var reportes_clientes_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ header: "Usuario", width: 60, dataIndex: 'usuario'},
			{ id: 'nombre',  header: "Nombre",  dataIndex: 'nombre'},
			{ header: "Apellido", width: 150, dataIndex: 'apellido'},
			{ header: "Identificacion", width: 100, dataIndex: 'identificacion'},
			{ header: "Tipo de identificacion", width: 80,  dataIndex: 'tipo_identificacion'},
			{ header: "Direccion", width: 80,  dataIndex: 'direccion'},
			{ header: "Telefono", width: 60,  dataIndex: 'telefono'},
			{ header: "e_mail", width: 100,  dataIndex: 'e_mail'},
			{ header: "Habilitado", width: 70,  dataIndex: 'habilitado'}
		]
	});
	
	var codigo_usuario = '';
	
	var reportes_clientes_gridpanel = new Ext.grid.GridPanel({
		id: 'reportes_clientes_gridpanel',
		title: 'Clientes',
		columnWidth: '.6',
		stripeRows:true,
		frame: true,
		ds: reportes_clientes_datastore,
		cm: reportes_clientes_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					codigo_usuario = rec.get('codigo');
					reportes_programacion_cancion_datastore.load(
						{
							params: {
								codigo_usuario: rec.get('codigo')
							}
						}
					);
				}
			}
		}),
		autoExpandColumn: 'nombre',
		autoExpandMin: 100,
		height: 450,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		tbar: [
			{
				xtype: 'textfield',
				id: 'reportes_clientes_buscar_textfield'
			},'-',
			{
				xtype: 'button',
				text: 'Suscar',
				iconCls: 'buscar16',
				handler: function(){
					reportes_clientes_datastore.load({
						params: {buscar: Ext.getCmp('reportes_clientes_buscar_textfield').getValue()}
					});
					reportes_programacion_cancion_datastore.removeAll();
				}
			}
		],
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: reportes_clientes_datastore,
			displayInfo: true,
			displayMsg: 'Clientes {0} - {1} de {2}',
			emptyMsg: "No hay clientes"
		}),
		view: new Ext.grid.GroupingView()
    });
	
//////////////****************///////////////

	var reportes_programacion_cancion_datastore = new Ext.data.GroupingStore({
		id: 'reportes_programacion_cancion_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'reportes/listarProgramacioncancion',//getAbsoluteUrl('gestionar_cancion','listarCancion'), 
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
			{name: 'can_ranking'},
			{name: 'can_fecha'},
			{name: 'can_inicio'}
		]),
		sortInfo: {field: 'can_nombre', direction: "ASC"},
		groupField: 'can_fecha'
	});
	//reportes_programacion_cancion_datastore.load();

	function can_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cancion" onClick="fun_can_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var reportes_programacion_cancion_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ id: 'imagen', header: "Play", width: 50, dataIndex: 'imagen', renderer: can_ponericono},
			{ id: 'can_nombre_col_id',  header: "Nombre",  dataIndex: 'can_nombre'},
			{ header: "Autor", width: 120, dataIndex: 'can_autor'},
			{ header: "Album", width: 120, dataIndex: 'can_album'},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'can_duracion'},
			{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney},
			{ header: "Fecha", width: 80,  dataIndex: 'can_fecha'},
			{ header: "Inicio", width: 80,  dataIndex: 'can_inicio'}
		]
	});
	var can_url = '';
	
	var reportes_programacion_cancion_gridpanel = new Ext.grid.GridPanel({
		id: 'cancion_gridpanel',
		title:'Programaci&oacute;n de canciones',
		columnWidth: '.4',
		stripeRows:true,
		frame: true,
		ds: reportes_programacion_cancion_datastore,
		cm: reportes_programacion_cancion_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					can_url = rec.get('can_url');
				}
			}
		}),
		autoExpandColumn: 'can_nombre_col_id',
		autoExpandMin: 120,
		height: 478,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		tbar: [
			{
				xtype: 'label',
				text: 'Desde:'
			},
			{
				xtype: 'datefield',
				id: 'reportes_programacion_desde_datefield'
			},'-',
			{
				xtype: 'label',
				text: 'Hasta:'
			},
			{
				xtype: 'datefield',
				id: 'reportes_programacion_hasta_datefield'
			},'-',
			{
				xtype: 'button',
				text: 'Buscar',
				iconCls: 'buscar16',
				handler: function(){
					if(codigo_usuario != ''){
						if(Ext.getCmp('reportes_programacion_desde_datefield').getValue() != ''){
							if(Ext.getCmp('reportes_programacion_hasta_datefield').getValue() != ''){
								reportes_programacion_cancion_datastore.load(
									{
										params: {
											codigo_usuario: codigo_usuario,
											desde: Ext.getCmp('reportes_programacion_desde_datefield').getValue().format('Y-m-d'),
											hasta: Ext.getCmp('reportes_programacion_hasta_datefield').getValue().format('Y-m-d')
										}
									}
								);
							}
							else{
								reportes_programacion_cancion_datastore.load(
									{
										params: {
											codigo_usuario: codigo_usuario,
											desde: Ext.getCmp('reportes_programacion_desde_datefield').getValue().format('Y-m-d')
										}
									}
								);
							}
						}
						if(Ext.getCmp('reportes_programacion_hasta_datefield').getValue() != ''){
							if(Ext.getCmp('reportes_programacion_desde_datefield').getValue() != ''){
								reportes_programacion_cancion_datastore.load(
									{
										params: {
											codigo_usuario: codigo_usuario,
											desde: Ext.getCmp('reportes_programacion_desde_datefield').getValue().format('Y-m-d'),
											hasta: Ext.getCmp('reportes_programacion_hasta_datefield').getValue().format('Y-m-d')
										}
									}
								);
							}
							else{
								reportes_programacion_cancion_datastore.load(
									{
										params: {
											codigo_usuario: codigo_usuario,
											desde: Ext.getCmp('reportes_programacion_hasta_datefield').getValue().format('Y-m-d')
										}
									}
								);
							}
						}
						if(Ext.getCmp('reportes_programacion_desde_datefield').getValue() == '' &&
							Ext.getCmp('reportes_programacion_hasta_datefield').getValue() == ''){
							mostrarMensajeConfirmacion('Error', 'Por favor seleccione una fecha para realizar la busqueda');
						}
					}
					else{
						mostrarMensajeConfirmacion('Error', 'Por favor seleccione un cliente');
					}
				}
			}
		],
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: reportes_programacion_cancion_datastore,
			displayInfo: true,
			displayMsg: 'Canciones {0} - {1} de {2}',
			emptyMsg: "No hay canciones programadas"
		}),
		view: new Ext.grid.GroupingView()
    });
	
	var reportes_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'reportes_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		monitorResize:true,
		layout:'column',
		items: 
		[
			reportes_clientes_gridpanel, 
			reportes_programacion_cancion_gridpanel
		],
		buttons: [
			{
				text: 'Imprimir',
				iconCls: 'pdf',
				handler: function_imprimir
			}
		],
		renderTo:'div_form_reportes'
	});

/***********************************FUNCIONES*****************************/
	
	function function_imprimir(){
		var buscar = Ext.getCmp('reportes_clientes_buscar_textfield').getValue();
		var desde = Ext.getCmp('reportes_programacion_desde_datefield').getValue().format('Y-m-d');
		var hasta = Ext.getCmp('reportes_programacion_hasta_datefield').getValue().format('Y-m-d');
		window.location = 'reportes/imprimir?buscar='+buscar+'&desde='+desde+'&hasta='+hasta;
	}

	function fun_can_descargar(){
		if(can_url!=''){
			//alert(can_url);
			var url = url_web+can_url; 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}

