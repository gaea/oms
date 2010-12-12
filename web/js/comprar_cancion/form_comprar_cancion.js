
	var cancion_disponible_datastore = new Ext.data.GroupingStore({
		id: 'cancion_disponible_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'comprar_cancion/listarCanciondisponible',//getAbsoluteUrl('comprar_cancion','listarCanciondisponible'), 
			method: 'POST',
			limit: 10,
			star: 0
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
	cancion_disponible_datastore.load();

	var url_cancion;
	
	function can_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cancion" onClick="fun_can_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
	
	var cancion_disponible_seleccionar_cancion_selectionmodel = new Ext.grid.CheckboxSelectionModel({
		checkOnly: true,
		listeners: {
			rowselect: function(sm, row, rec) {
						
			}
		}
	});
 	
	var cancion_disponible_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			cancion_disponible_seleccionar_cancion_selectionmodel,
			//{ header: "Play", width: 50, dataIndex: 'imagen', renderer: can_ponericono},
			{ id: 'can_dis_nombre_col_id',  header: "Nombre",  dataIndex: 'can_nombre'},
			{ header: "Autor", width: 100, dataIndex: 'can_autor'},
			{ header: "Album", width: 180, dataIndex: 'can_album'},
			{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'can_duracion'},
			
		]
	});
	
	var cancion_disponible_gridpanel = new Ext.grid.GridPanel({
		id: 'cancion_disponible_gridpanel',
		title:'Canciones disponibles',
		columnWidth: '.5',
		stripeRows:true,
		frame: true,
		ds: cancion_disponible_datastore,
		cm: cancion_disponible_colmodel,
		sm: cancion_disponible_seleccionar_cancion_selectionmodel,
		autoExpandColumn: 'can_dis_nombre_col_id',
		autoExpandMin: 150,
		height: 450,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		tbar: [
			{
				xtype: 'textfield',
				id: 'cancion_disponible_buscar_textfield'
			},
			{
				xtype: 'button',
				text: 'Buscar',
				handler: fun_can_buscar,
				iconCls: 'buscar16'
			},
			'->',{
				xtype: 'button',
				text: 'Comprar',
				handler: fun_can_comprar,
				iconCls: 'crear16'
			}
		],
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: cancion_disponible_datastore,
			displayInfo: true,
			displayMsg: 'Canciones {0} - {1} de {2}',
			emptyMsg: "No hay canciones"
		}),
		view: new Ext.grid.GroupingView()
    });
	
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
			{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'can_duracion'},
		]
	});
	
	var cancion_adquirida_gridpanel = new Ext.grid.GridPanel({
		id: 'cancion_adquirida_gridpanel',
		title:'Canciones adquiridas',
		columnWidth: '.5',
		style: {"margin-left": "10px"},
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
		height: 463,
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
	
	var cancion_contenedor_panel = new Ext.Panel({
		frame: true,
		id: 'cancion_contenedor_panel',
		//	height: largo_panel,
		padding: '5px',
		autoWidth: true,
		border: true,
		tabTip :'Aqui puedes comprar canciones',
		//monitorResize:true,
		layout:'column',
		items: 
		[
			cancion_disponible_gridpanel, 
			cancion_adquirida_gridpanel
		],
		renderTo:'div_form_comprar_cancion'
	});

/***********************************FUNCIONES*****************************/

	function fun_can_comprar(){
		var numero_canciones = cancion_disponible_seleccionar_cancion_selectionmodel.getCount();
		if(numero_canciones > 0){
			var canciones = cancion_disponible_seleccionar_cancion_selectionmodel.getSelections();
			var array_codigo_canciones = new Array();
			for(i=0; i<numero_canciones; i++){
				array_codigo_canciones.push(canciones[i].get('can_codigo'));
				//mostrarMensajeRapido('Codigo', canciones[i].get('can_codigo')+'');
			}
			subirDatosAjax(
				'comprar_cancion/comprarCancion',
				{canciones: Ext.util.JSON.encode(array_codigo_canciones)},
				function(){
					cancion_adquirida_datastore.reload();
					//mostrarMensajeRapido('Aviso','Compra hecha satisfactoriamente');
				},
				function(){}
			);
		}
		else{
			mostrarMensajeRapido('Error','Por favor seleccione una canci&oacute;n');
		}
	}
	
	function fun_can_buscar(){
		cancion_disponible_datastore.load({
			params: {
				buscar: Ext.getCmp('cancion_disponible_buscar_textfield').getValue(),
				start: 0,
				limit: 10
			}
		});
	}

	function fun_can_descargar(){
		if(url_cancion != ''){
			//alert(Ext.getCmp('can_url').getValue());
			var url = url_web+url_cancion; 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}
