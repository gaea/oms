
	var interfaz_visualizacion_contenedor_panel = new Ext.Panel({
		frame: true,
		padding: '5px',
		autoWidth: true,
		height: 500,
		border: true,
		tabTip :'Visualizaci&oacute;n',
		monitorResize:true,
		layout:'column',
		items: 
		[
			{
				xtype: 'panel',
				width: 483,
				columnWidth: 0.5,
				id: 'interfaz_visualizacion_canciones_panel',
				height: 470,
				title: 'Musica para los empleados',
				frame: true
			},
			{
				xtype: 'panel',
				width: 483,
				columnWidth: 0.5,
				id: 'interfaz_visualizacion_mensajes_panel',
				height: 470,
				title: 'Mensajes para los empleados',
				frame: true,
				items:[
					{
						xtype: 'textarea',
						width: 300,
						height: 300,
						id: 'interfaz_visualizacion_mensaje_textfield'
					}
				]
			}
		],
		renderTo:'div_form_interfaz_visualizacion'
	});
	
	var interfaz_visualizacion_canciones_template = new Ext.Template('<div id="div_form_interfaz_visualizacion_musica" ></div>');
	
	Ext.getCmp('interfaz_visualizacion_canciones_panel').add(interfaz_visualizacion_canciones_template);
	Ext.getCmp('interfaz_visualizacion_canciones_panel').doLayout(true, true);
	
	var so = new SWFObject('../mediaplayer/player.swf','mpl','470','435','9');
	so.addParam('allowfullscreen','false');
	so.addParam('allowscriptaccess','always');
	so.addParam('wmode','opaque');
	so.addVariable('playlistfile','../rss/2.xml');
	so.addVariable('playlistsize', '300');
	so.addVariable('plugins','../mediaplayer/plugins/revolt.swf');
	so.addVariable('skin','../mediaplayer/skins/beelden/beelden.xml');
	so.addVariable('playlist','bottom');
	so.write('div_form_interfaz_visualizacion_musica');
	
	var Comet = Class.create();
	Comet.prototype = {

	  timestamp: 0,
	  url: 'interfaz_visualizacion/publicarMensaje',
	  noerror: true,

	  initialize: function() { },

	  connect: function()
	  {
		this.ajax = new Ajax.Request(this.url, {
		  method: 'get',
		  parameters: { 'timestamp' : this.timestamp },
		  onSuccess: function(transport) {
			// handle the server response
			var response = transport.responseText.evalJSON();
			this.comet.timestamp = response['timestamp'];
			this.comet.handleResponse(response);
			this.comet.noerror = true;
		  },
		  onComplete: function(transport) {
			// send a new ajax request when this request is finished
			if (!this.comet.noerror)
			  // if a connection problem occurs, try to reconnect each 5 seconds
			  setTimeout(function(){ comet.connect() }, 5000); 
			else
			  this.comet.connect();
			this.comet.noerror = false;
		  }
		});
		this.ajax.comet = this;
	  },

	  disconnect: function()
	  {
	  },

	  handleResponse: function(response)
	  {
		//alert(response['msg']);
		Ext.getCmp('interfaz_visualizacion_mensaje_textfield').setValue(response['msg']);
		//$('content').innerHTML += '<div>' + response['msg'] + '</div>';
	  },

	  doRequest: function(request)
	  {
		new Ajax.Request(this.url, {
		  method: 'get',
		  parameters: { 'msg' : request }
		});
	  }
	}
	var comet = new Comet();
	comet.connect();

/***********************************FUNCIONES*****************************/

