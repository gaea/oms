
	var login_cliente_form_panel = new Ext.FormPanel({
			title:'Ingreso Sistema',
			height: 200,
			width: 350,
			border:true,
			defaults:{xtype:'textfield'},
			items:
			[
				{
					fieldLabel:'Login',
					name:'login_usuario',
					id:"login_usuario",
					allowBlank:false
				},
				{
					fieldLabel:'Password',
					inputType: 'password',
					name:'pass_usuario',
					id:'pass_usuario',
					allowBlank:false
				}
			],
			buttons:
			[
				{
					text:'Aceptar',
					id:'btn_aceptar',
					handler: fun_cliente_login,
				}
			],
				renderTo:'div_form_login_cliente'
	});
	
	function fun_cliente_login(){
		subirDatos(
			login_cliente_form_panel,
			'login/autenticar',
			{
				login_usuario: Ext.getCmp('login_usuario').getValue(),
				password_usuario: Ext.getCmp('pass_usuario').getValue()
			
			},
			function(){
				window.location = 'interfaz_cliente';
				//Ext.Msg.alert('Exito', 'se pudo conectar');
			},
			function()
			{
				Ext.Msg.alert('Error', 'no se pudo conectar');
			}
		);
	}

