
	var login_cliente_form_panel = new Ext.FormPanel({
			title:'Ingreso Sistema',
			frame:true,
			height: 160,
			width: 350,
			border:true,
			bodyStyle:'padding: 10px',
			style: {
			  "margin":"50px auto"
			},
			defaults:{xtype:'textfield'},
			items:
			[
				{
					anchor: '100%',
					fieldLabel:'Login',
					name:'login_usuario',
					id:"login_usuario",
					allowBlank:false
				}
			],
			buttons:
			[
				{
					xtype: 'button',
					text:'Entrar',
					id:'btn_aceptar',
					handler: fun_cliente_login,
					iconCls: 'login'
				}
			],
				renderTo:'div_form_login_visualizacion'
	});
		
	function fun_cliente_login(){
		subirDatos(
			login_cliente_form_panel,
			'login/autenticar',//getAbsoluteUrl('login','autenticar'), //'login/autenticar',
			{
				login_usuario: Ext.getCmp('login_usuario').getValue()
			},
			function(){
				window.location = 'interfaz_visualizacion';
				//Ext.Msg.alert('Exito', 'se pudo conectar');
			},
			function()
			{
				//Ext.Msg.alert('Error', 'no se pudo conectar');
			}
		);
	}

