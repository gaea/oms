
	var interfaz_visualizacion_contenedor_panel = new Ext.Panel({
		frame: true,
		padding: '5px',
		autoWidth: true,
		height: 500,
		border: true,
		tabTip :'Visualizaci&oacute;n',
		monitorResize:true,
		//layout:'column',
		items: 
		[
			{
				xtype: 'panel',
				width: 483,
				id: 'interfaz_visualizacion_canciones_panel',
				height: 470,
				title: 'Musica para los empleados',
				frame: true
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

/***********************************FUNCIONES*****************************/

