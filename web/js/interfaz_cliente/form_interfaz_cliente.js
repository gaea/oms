
	var interfaz_cliente_panel = new Ext.Panel({
		frame: true,
		id: 'interfaz_cliente_panel',
		autoHeight: true,
		autoWidth: true,
		border: true,
		tbar: [
			{html: 'Bienvenido a OMS'},
			'->',
			{
				xtype: 'button',
				text: 'Terminar sesi&oacute;n',
				handler: fun_cliente_panel_salir,
				iconCls: 'salir16'
			}
		],
		items: [
			{
				xtype: 'tabpanel',
				activeTab: 0,
				items: [
					{
						title: 'Comprar Canciones',
						tabTip: 'Comprar Canciones',
						autoScroll: true,
						autoLoad: {url: 'comprar_cancion/index', scripts: true, scope: this}
					},
					{
						title: 'Subir Cu&ntilde;as',
						tabTip: 'Subir Cu&ntilde;as',
						autoScroll: true,
						autoLoad: {url: 'subir_cunia/index', scripts: true, scope: this}
					},
					{
						title: 'Publicar Mensaje',
						tabTip: 'Publicar Mensaje',
						autoScroll: true,
						autoLoad: {url: 'publicar_mensaje/index', scripts: true, scope: this}
					},
					{
						title: 'Programar Canciones',
						tabTip: 'Programar Canciones',
						autoScroll: true,
						autoLoad: {url: 'programar_cancion/index', scripts: true, scope: this}
					},
					{
						title: 'Programar Cu&ntilde;as',
						tabTip: 'Programar Cu&ntilde;as',
						autoScroll: true,
						autoLoad: {url: 'programar_cunia/index', scripts: true, scope: this}
					},
					{
						title: 'Gestion de Cliente',
						tabTip: 'Actualizar datos del cliente',
						autoScroll: true,
						autoLoad: {url: 'actualizar_cliente/index', scripts: true, scope: this}
					}
				]
			}
		],
		renderTo:'div_form_interfaz_cliente'
	});
	
	function fun_cliente_panel_salir(){
		subirDatosAjax(
			'login/desautenticar',
			{},
			function(){
				window.location = 'login';
			},
			function(){}
		);
	}
