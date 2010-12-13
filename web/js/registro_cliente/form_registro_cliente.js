		
		var data=['T.I','C.C'];  
		
		 var comboTipoId =new Ext.form.ComboBox({  
			 fieldLabel:'Tipo id',
			 name:'combo_tipo_id',
			 forceSelection:true,
			 store:data,  
			 emptyText:'[seleccione uno]',  
			 triggerAction: 'all',
			 editable:false,
			 minChars:3  
		 }); 

		var registro_cliente_form_panel = new Ext.FormPanel({
			border:false,
			defaults:{xtype:'textfield'},
			items:[
				{
					fieldLabel:'Nombre',
					name:'nombre_usuario',
					id:"nombre_usuario",
					allowBlank:false
				},
				{
					fieldLabel:'Apellido',
					name:'apellido_usuario',
					id:'apellido_usuario',
					allowBlank:false
				},
				comboTipoId,
				{
					fieldLabel:'No. identificacion',
					name:'idetificacion_usuario',
					id:'identificacion_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Direccion',
					name:'direccion_usuario',
					id:'direccion_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Telefono',
					name:'telefono_usuario',
					id:'telefono_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Correo-e',
					name:'email_usuario',
					id:'email_usuario',
					allowBlank:false
				},
				{
					fieldLabel:'Login',
					name:'login_usuario',
					id:"login_usuario"
				},
				{
					fieldLabel:'Password',
					inputType: 'password',
					name:'pass_usuario',
					id:'pass_usuario'
				}
			],
			buttons:
			[
				{
					text:'Aceptar',
					id:'btn_aceptar',
					handler: function(){  
						if(Ext.getCmp('login_usuario').isValid() && Ext.getCmp('pass_usuario').isValid()){
							//autenticar();
							Ext.Msg.alert('Exito','campos completos');  
						}
						else{
							Ext.Msg.alert('Error', 'campos incompletos');
						}
				   }
				},
				{
					text:'Cancelar',
					id:'btn_cancelar',
					handler: function(){  
							Ext.Msg.alert('Salir', 'Chao');
				   }
				}
			],
			renderTo:'div_form_registro_cliente'
		});
