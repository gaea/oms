
	var interfaz_admin_panel = new Ext.Panel({
		frame: true,
		id: 'interfaz_admin_panel',
		autoHeight: true,
		autoWidth: true,
		border: true,
		tbar: [
			{html: 'Bienvenido a el modulo de administraci&oacute;n de OMS'},
			'->',
			{
				xtype: 'button',
				text: 'Terminar sesi&oacute;n',
				handler: fun_admin_panel_salir,
				iconCls: 'salir16'
			}
		],
		items: [
			{
				xtype: 'tabpanel',
				activeTab: 0,
				items: [
					{
						title: 'Gestionar canci&oacute;n',
						tabTip: 'Gestionar canci&oacute;n',
						autoScroll: true,
						autoLoad: {url: 'gestionar_cancion/index', scripts: true, scope: this}
					},
					{
						title: 'Gestionar usuarios administradores',
						tabTip: 'Gestionar usuarios administradores',
						autoScroll: true,
						autoLoad: {url: 'reportes/index', scripts: true, scope: this}
					}
				]
			}
		],
		renderTo:'div_form_interfaz_admin'
	});
	
	function fun_admin_panel_salir(){
		subirDatosAjax(
			'login/desautenticar',
			{},
			function(){
				window.location = 'login';
			},
			function(){}
		);
	}
