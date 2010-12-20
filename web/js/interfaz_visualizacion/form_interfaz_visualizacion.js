	
	
	var interfaz_visualizacion_contenedor_panel = new Ext.Panel({
		frame: true,
		padding: '5px',
		autoWidth: true,
		height: 530,
		border: true,
		tabTip :'Visualizaci&oacute;n',
		monitorResize:true,
		//layout:'column',
		items: [
			{
				xtype: 'panel',
				layout:'column',
				//frame: true,
				items: 
				[
					{
						xtype: 'panel',
						columnWidth: 0.3,
						padding: 0,
						id: 'interfaz_visualizacion_canciones_panel',
						height: 470,
						title: 'Musica para los empleados',
						frame: true
					},
					{
						xtype: 'panel',
						columnWidth: 0.3,
						padding: 0,
						id: 'interfaz_visualizacion_cunias_panel',
						height: 470,
						title: 'Cu&ntilde;as para los empleados',
						frame: true
					},
					{
						xtype: 'panel',
						//width: 483,
						columnWidth: 0.4,
						id: 'interfaz_visualizacion_mensajes_panel',
						height: 470,
						title: 'Mensajes para los empleados',
						frame: true,
						items:[
							{
								xtype: 'htmleditor',
								anchor: '100%',
								height: 435,
								enableAlignments: false,
								enableColors: false,
								enableFont: false,
								enableFontSize: false,
								enableFormat: false,
								enableLinks: false,
								enableLists: false,
								enableSourceEdit: false,
								id: 'interfaz_visualizacion_mensaje_htmleditor'
							}
						]
					}
				],
				tbar:[
					{
						xtype: 'label',
						html: 'Bienvenido a OMS'
					}
				],
				bbar:[
					{
						xtype: 'label',
						html: 'powered by JW Player'
					}
				]
			}
		],
		renderTo:'div_form_interfaz_visualizacion'
	});
	
	var interfaz_visualizacion_canciones_template = new Ext.Template('<div id="div_form_interfaz_visualizacion_canciones" ></div>');
	
	Ext.getCmp('interfaz_visualizacion_canciones_panel').add(interfaz_visualizacion_canciones_template);
	Ext.getCmp('interfaz_visualizacion_canciones_panel').doLayout(true, true);
	
	ancho_cancion_jwplayer = Ext.getCmp('interfaz_visualizacion_canciones_panel').getWidth() - 12 ;
	
	var canciones_jwplayer = new SWFObject('../mediaplayer/player.swf','mpl',ancho_cancion_jwplayer,'435','9');
	canciones_jwplayer.addParam('allowfullscreen','false');
	canciones_jwplayer.addParam('allowscriptaccess','always');
	canciones_jwplayer.addParam('wmode','opaque');
	canciones_jwplayer.addVariable('playlistfile','../rss/'+document.getElementById("div_codigo").innerHTML+'.xml');
	canciones_jwplayer.addVariable('playlistsize', '300');
	canciones_jwplayer.addVariable('plugins','../mediaplayer/plugins/revolt.swf');
	canciones_jwplayer.addVariable('skin','../mediaplayer/skins/beelden.zip');
	canciones_jwplayer.addVariable('playlist','bottom');
	canciones_jwplayer.write('div_form_interfaz_visualizacion_canciones');
	
	var interfaz_visualizacion_cunias_template = new Ext.Template('<div id="div_form_interfaz_visualizacion_cunias" ></div>');
	
	Ext.getCmp('interfaz_visualizacion_cunias_panel').add(interfaz_visualizacion_cunias_template);
	Ext.getCmp('interfaz_visualizacion_cunias_panel').doLayout(true, true);
	
	ancho_cunia_jwplayer = Ext.getCmp('interfaz_visualizacion_cunias_panel').getWidth() - 12 ;
	
	var cunias_jwplayer = new SWFObject('../mediaplayer/player.swf','mpl',ancho_cunia_jwplayer,'435','9');
	cunias_jwplayer.addParam('allowfullscreen','false');
	cunias_jwplayer.addParam('allowscriptaccess','always');
	cunias_jwplayer.addParam('wmode','opaque');
	cunias_jwplayer.addVariable('playlistfile','../rss/cunias.xml');
	cunias_jwplayer.addVariable('playlistsize', '300');
	cunias_jwplayer.addVariable('plugins','../mediaplayer/plugins/revolt.swf');
	cunias_jwplayer.addVariable('skin','../mediaplayer/skins/beelden.zip');
	cunias_jwplayer.addVariable('playlist','bottom');
	cunias_jwplayer.write('div_form_interfaz_visualizacion_cunias');
	
	
	var comet = new Comet();
	comet.connect();

/***********************************FUNCIONES*****************************/

