

	var cancion_datastore = new Ext.data.GroupingStore({
		id: 'cancion_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'gestionar_cancion/listarCancion',//getAbsoluteUrl('gestionar_cancion','listarCancion'), 
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
	cancion_datastore.load();

	function can_ponericono(val,x,store){
		//return '<img src="'+url_web+'images/iconos/play.png">';
		return '<button type="button" name="button_descargar_cancion" onClick="fun_can_descargar()"> <img src="'+url_web+'images/Next16.png"> </button>'
	}
 	
	var cancion_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{ id: 'imagen', header: "Play", width: 50, dataIndex: 'imagen', renderer: can_ponericono},
			{ id: 'can_nombre_col_id',  header: "Nombre",  dataIndex: 'can_nombre'},
			{ header: "Autor", width: 150, dataIndex: 'can_autor'},
			{ header: "Album", width: 200, dataIndex: 'can_album'},
			{ header: "Duraci&oacute;n", width: 60,  dataIndex: 'can_duracion'},
			{ header: "Precio", width: 80,  dataIndex: 'can_precio', renderer: Ext.util.Format.usMoney}
		]
	});
	
	var codigo_cancion_actualizar = '';
	
	var cancion_gridpanel = new Ext.grid.GridPanel({
		id: 'cancion_gridpanel',
		title:'Canciones',
		columnWidth: '.6',
		stripeRows:true,
		frame: true,
		ds: cancion_datastore,
		cm: cancion_colmodel,
		sm: new Ext.grid.RowSelectionModel({
			singleSelect: true,
			listeners: {
				rowselect: function(sm, row, rec) {
					Ext.getCmp('cancion_formpanel').getForm().loadRecord(rec);
					Ext.getCmp('can_crear_boton').setText('Nuevo');
					Ext.getCmp('can_descargar_boton').setDisabled(false);
					Ext.getCmp('can_cancelar_boton').setDisabled(false);
					codigo_cancion_actualizar = rec.get('can_codigo');
				}
			}
		}),
		autoExpandColumn: 'can_nombre_col_id',
		autoExpandMin: 200,
		height: 450,
		listeners: {
			viewready: function(g) {
				g.getSelectionModel().selectRow(0);
			}
		},
		bbar: new Ext.PagingToolbar({
			pageSize: 10,
			store: cancion_datastore,
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
		tabTip :'Aqui puedes ver, agregar , cancelar y descargar canciones',
		monitorResize:true,
		layout:'column',
		items: 
		[
			cancion_gridpanel, 
			//cancion_formpanel
		],
		renderTo:'div_form_reportes'
	});

/***********************************FUNCIONES*****************************/

	function fun_can_crear(){
		
		if(Ext.getCmp('can_crear_boton').getText()=='Nuevo'){
			cancion_formpanel.getForm().reset();
			Ext.getCmp('can_crear_boton').setText('Guardar');
			Ext.getCmp('can_descargar_boton').setDisabled(true);
			Ext.getCmp('can_cancelar_boton').setText('Cancelar');
			Ext.getCmp('can_cancelar_boton').setDisabled(false);
		}

		if(Ext.getCmp('can_crear_boton').getText()=='Guardar'){ 
			var verificacion =fun_can_verificarCamposDocumento();
	  
	 		if(verificacion){
				subirDatos(
					cancion_formpanel,
					'gestionar_cancion/crearCancion',//getAbsoluteUrl('gestionar_cancion','crearCancion'),//
					{},
					function(){
						Ext.getCmp('can_crear_boton').setText('Nuevo');
						//Ext.getCmp('can_cancelar_boton').setText('Eliminar');
						Ext.getCmp('can_descargar_boton').setDisabled(false);
						cancion_datastore.reload(); 
					},
					function(){}
				);
			}
		}
	}
	

	function fun_can_descargar(){
		if(Ext.getCmp('can_url').getValue()!=''){
			//alert(Ext.getCmp('can_url').getValue());
			var url = url_web+Ext.getCmp('can_url').getValue(); 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}
    
	function fun_can_cancelar(){
		if(Ext.getCmp('can_cancelar_boton').getText()=='Cancelar'){
		    Ext.getCmp('can_crear_boton').setText('Nuevo');
		    Ext.getCmp('can_descargar_boton').setDisabled(false);
		}
	}

	function fun_can_verificarCamposDocumento(){
		var valido=true;
		return valido;
	}
