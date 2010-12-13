
	var publicar_mensaje_contenedor_panel = new Ext.Panel({
		frame: true,
		padding: '5px',
		autoWidth: true,
		height: 405,
		border: true,
		tabTip :'Aqui puedes publicar los mensajes a tus empleados',
		monitorResize:true,
		//layout:'column',
		items: 
		[
			{
				xtype: 'form',
				title: 'Mensajes para los empleados',
				frame: true,
				padding: '5px',
				items: 
				[
					{
						xtype: 'htmleditor',
						anchor: '100%',
						height: 300,
						id: 'publicar_mensaje_mensaje_textfield',
						name: 'publicar_mensaje_mensaje_textfield',
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
		
	}