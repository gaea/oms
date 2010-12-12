	
	var login_admin_formpanel = new Ext.FormPanel({
		title: 'Ingreso',
		frame: true,
		height: 180,
		padding: '10px',
		width: 350,
		border: true,
		items: 
		[
			{
				xtype:'textfield',
				fieldLabel: 'Login',
				//id: 'login_usuario',
				anchor: '100%',
				allowBlank: false,
				name: 'login_usuario'
			},
			{
				xtype:'textfield',
				fieldLabel: 'Password',
				//id: 'password_usuario',
				anchor: '100%',
				allowBlank: false,
				name: 'password_usuario',
				inputType: 'password',
			}
		],
		buttons:
		[
			{	
				text: 'Entrar',
				handler: fun_admin_login,
				iconCls: 'login'
			}
		],
		renderTo:'div_form_login_admin'
	});
	
	function fun_admin_login(){
		subirDatos(
			login_admin_formpanel,
			'login/autenticar',
			{},
			function(){
				window.location = 'interfaz_admin';
			},
			function(){}
		);
	}