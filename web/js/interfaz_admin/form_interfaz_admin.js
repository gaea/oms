
	var interfaz_admin_panel = new Ext.TabPanel({
		frame: true,
		id: 'interfaz_admin_panel',
		autoHeight: true,
		autoWidth: true,
		border: true,
		activeTab: 0,
		tbar: [
			'->',{
				xtype: 'button',
				text: 'Salir',
				handler: fun_admin_panel_salir,
				iconCls: 'salir16'
			}
		],
		items: [
			{
				title: 'Gestionar canci&oacute;n',
				tabTip: 'Gestionar canci&oacute;n',
				autoScroll: true,
				autoLoad: {url: 'gestionar_cancion/index', scripts: true, scope: this}
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
