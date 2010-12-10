//aqui va el js asociado a la cancion

﻿	var url_arc_web='';

	
	
   //CREACION DE FORMULARIO
	var cancion_formpanel = new Ext.FormPanel({
		title:'Datos detallados de la canci&oacute;n ',
		columnWidth:'.4',
		frame:true,
		id:'cancion_formpanel',
		fileUpload: true,
		style: {"margin-left": "10px"},
		bodyStyle: 'padding:5px',
		defaults:{xtype:'textfield',anchor:'100%'},
		items:
		[
			{
				fieldLabel: 'Nombre',
				id: 'can_nombre',
				name: 'can_nombre',
			//--	emptyText: 'Nombre ',
				maxLength: 100,
				maskRe: /([a-zA-Z0-9\s]+)$/,
				//allowBlank: false
			},
			{
				fieldLabel: 'Autor',
				id: 'can_autor',
				name: 'can_autor',
			//--	emptyText: 'Autor ',
				maxLength: 100,
				maskRe: /([a-zA-Z0-9\s]+)$/,
				//allowBlank: false
			},
			{
				fieldLabel: 'Album',
				id: 'can_album',
				name: 'can_album',
			//--	emptyText: 'album ',
				maxLength: 100,
				maskRe: /([a-zA-Z0-9\s]+)$/,
				//allowBlank: false
			},
			
			{
				xtype:'datefield',
				fieldLabel: 'Fecha de publicaci&oacute;n',
				id: 'can_fecha_de_publicacion',
				name: 'can_fecha_de_publicacion',
			//--	emptyText: 'FEcha de prublicacion',
				format: 'Y-m-d'
			},
			{
				xtype:'textfield',
				fieldLabel: 'Duraci&oacute;n',
				id: 'can_duracion',
				name: 'can_duracion',
				value:'00:00:00'//,
				//maskRe : /([0-9]\:)$/  
			//--	emptyText: 'duracion'
			},
			{
				xtype: 'fileuploadfield', 
				id: 'can_url', 
				emptyText: 'Seleccione una cancion', 
				fieldLabel: 'Escoger',
				name: 'can_archivo',
				buttonText: '',
				allowBlank:false,
				buttonCfg: {iconCls: 'archivo'}
		  	},
			{
				xtype:'checkbox',
				fieldLabel: 'Habilitada',
				id: 'can_habilitada',
				name: 'can_habilitada'
			//--	emptyText: 'habilitada'
			},
			{
				xtype:'numberfield',
				fieldLabel: 'Precio',
				id: 'can_precio',
				name: 'can_precio',
			//--	emptyText: 'precio',
				allowDecimal:true
			},
			{
				xtype:'numberfield',
				fieldLabel: 'Ranking',
				id: 'can_ranking',
				name: 'can_ranking',
			//--	emptyText: 'Ranking',
				allowDecimal:false
			},
			{
				id:'can_codigo',
				name: 'can_codigo',
				xtype:'hidden'
			}
		],
		buttons:
		[
			{	
				text:'Guardar',
				handler:fun_can_crear,
				id:'can_crear_boton',
				iconCls:'guardar',
				tooltip:'Pulse aqui para guardar nuevas canciones'
			},{
				text:'Cancelar',
				id: 'can_cancelar_boton',
				handler: fun_can_cancelar,
				iconCls: 'cancelar',
				tooltip: 'Seleccione una canci&oacute;n y pulse aqu&iacute; para cancelarlo'
			},{
				text:'Descargar',
				disabled:true,
				id:'can_descargar_boton',
				handler: fun_can_descargar,
				iconCls: 'descargar',
				tooltip: 'Seleccione una canci&oacute;n y pulse aqu&iacute; para descargarlo'
			}
		]	
	});


//creacion grid
	var cancion_datastore = new Ext.data.GroupingStore({
		id: 'cancion_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'gestionar_cancion/listarCancion',//getAbsoluteUrl('gestionar_cancion','listarCancion'), 
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
	cancion_datastore.load();

	function can_ponericono(val,x,store)
	{
		return '<img src="'+url_web+'images/iconos/play.png">';
	}
   
 	
	var cancion_colmodel = new Ext.grid.ColumnModel({
	defaults:{sortable: true, locked: false, resizable: true},
	columns:[
		{id: 'imagen', header: "Imagén", width: 60, dataIndex: 'imagen', renderer: can_ponericono},
		{ header: "Nombre",  dataIndex: 'can_nombre'},
		{ header: "Autor", width: 90, dataIndex: 'can_autor'},
		{ header: "Album", width: 90, dataIndex: 'can_album'},
		{ header: "Duraci&oacute;", width: 230,  dataIndex: 'can_duracion'},
		{ header: "Precio", width: 230,  dataIndex: 'can_precio'}
	]
	});

	
    //CREACION DELA GRILLA
    //cargamos el modelo de la tabla
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
					//Ext.getCmp('can_cancelar_boton').setText('Eliminar');
					Ext.getCmp('can_descargar_boton').setDisabled(false);
					Ext.getCmp('can_cancelar_boton').setDisabled(false);		
				}
			}
		}),
//		autoExpandColumn: 'can_descripcion',
		autoExpandMin: 200,
		height: 500,
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
	
/*INTEGRACION AL CONTENEDOR*/
	var cancion_contenedor_panel = new Ext.Panel({
		id: 'cancion_contenedor_panel',
	//	height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqui puedes ver, agregar , cancelar y descargar canciones',
		//monitorResize:true,
		layout:'column',
		items: 
		[
			cancion_gridpanel, 
			cancion_formpanel
		],
		renderTo:'div_form_cancion'
	});
   
   

/************************************************FUNCIONES*****************************/

	function fun_can_crear(){
		
		if(Ext.getCmp('can_crear_boton').getText()=='Nuevo')
		{
			cancion_formpanel.getForm().reset();
			Ext.getCmp('can_crear_boton').setText('Guardar');
			Ext.getCmp('can_descargar_boton').setDisabled(true);
			Ext.getCmp('can_cancelar_boton').setText('Cancelar');
			Ext.getCmp('can_cancelar_boton').setDisabled(false);
		}

		if(Ext.getCmp('can_crear_boton').getText()=='Guardar')
		{ 
			var verificacion =fun_can_verificarCamposDocumento();
	  
	 		 if(verificacion)
	  		{
				subirDatos(
					cancion_formpanel,
					getAbsoluteUrl('gestionar_cancion','crearCancion'),
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


        
	function fun_can_descargar()
	{
		if(Ext.getCmp('can_url').getValue()!='')
		{
		alert(Ext.getCmp('can_url').getValue());
			var url = url_web+Ext.getCmp('can_url').getValue(); 
			win = window.open(url,'Documento','height=400,width=400,resizable=1,scrollbars=1, menubar=1');
		}
		else{
			mostrarMensajeConfirmacion('Error',"Selecione una canci&oacute;n a descargar");
		}
	}
    
	function fun_can_cancelar()
	{
		if(Ext.getCmp('can_cancelar_boton').getText()=='Cancelar')
		{
		    Ext.getCmp('can_crear_boton').setText('Nuevo');
		    Ext.getCmp('can_descargar_boton').setDisabled(false);
		}
	}


	function fun_can_verificarCamposDocumento(){
		
		var valido=true;
		
		return valido;
	}

