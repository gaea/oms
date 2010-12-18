
	var publicar_mensaje_contenedor_panel = new Ext.Panel({
		frame: true,
		padding: '5px',
		autoWidth: true,
		height: 405,
		border: true,
		tabTip :'Aqui puedes publicar los mensajes a tus empleados',
		monitorResize:true,
		items: 
		[
			{
				xtype: 'form',
				title: 'Mensajes para los empleados',
				id: 'publicar_mensaje_mensaje_formpanel',
				frame: true,
				padding: '5px',
				items: 
				[
					{
						xtype: 'htmleditor',
						anchor: '100%',
						height: 300,
						id: 'publicar_mensaje_mensaje_textfield',
						name: 'mensaje',
						fieldLabel: 'Mensaje'
					}
				],
				buttons:
				[
					{	
						text: 'Publicar',
						handler: fun_publicar_mensaje_publicar,
						id: 'publicar_mensaje_publicar_boton',
						iconCls: 'crear16',
						tooltip: 'Pulse aqui para publicar el mensaje'
					}
				]
			}
		],
		renderTo:'div_form_publicar_mensaje'
	});

/***********************************FUNCIONES*****************************/

	function fun_publicar_mensaje_publicar(){
		subirDatos(
			Ext.getCmp('publicar_mensaje_mensaje_formpanel'), 
			'publicar_mensaje/PublicarMensaje', 
			{}, 
			function(){}, 
			function(){}
		);
	}