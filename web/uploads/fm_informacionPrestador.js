var InformacionPrestador = function () {
	
	var nombrePrestador = new Ext.form.TextField( {
		fieldLabel: 'Nombre', 
		emptyText: 'ingrese el nombre del prestador',
		anchor: '100%',
		id: 'prestador_nombre', 
		name: 'prestador_nombre', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_nombre')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                anchorOffset: 85,
			                html: 'Ingrese el nombre del prestador',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var activos = new Ext.form.TextField( {
		fieldLabel: 'Identificacion', 
		emptyText: 'ingrese los activos', 
		id: 'prestador_ico_activos', 
		name: 'prestador_ico_activos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_activos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los activos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var activosCorrientes = new Ext.form.TextField( {
		fieldLabel: 'Tipo de Identificacion', 
		emptyText: 'ingrese los activos corrientes', 
		id: 'prestador_ico_activos_corrientes', 
		name: 'prestador_ico_activos_corrientes', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_activos_corrientes')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los activos corrientes',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var efectivo = new Ext.form.TextField( {
		fieldLabel: 'Efectivo (Caja m&aacute;s bancos) ($)', 
		emptyText: 'ingrese la cantidad de efectivo', 
		id: 'prestador_ico_efectivo', 
		name: 'prestador_ico_efectivo', 
		anchor: '100%', 
		allowBlank:false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_efectivo')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese la cantidad de efectivo',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var deudores = new Ext.form.TextField( {
		fieldLabel: 'Deudores (Cuentas por Cobrar) ($)', 
		emptyText: 'ingrese la cantidad de deudores', 
		id: 'prestador_ico_deudores', 
		name: 'prestador_ico_deudores', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_deudores')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese la cantidad de deudores',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var inventario = new Ext.form.TextField( {
		fieldLabel: 'Inventario ($)', 
		emptyText: 'ingrese el inventario', 
		id: 'prestador_ico_inventario', 
		name: 'prestador_ico_inventario', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_inventario')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese el inventario',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var activosFijos = new Ext.form.TextField( {
		fieldLabel: 'Activos Fijos ($)', 
		emptyText: 'ingrese los activos fijos', 
		id: 'prestador_ico_activos_fijos', 
		name: 'prestador_ico_activos_fijos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_activos_fijos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los activos fijos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var propiedadPlantaEquipo = new Ext.form.TextField( {
		fieldLabel: 'Propiedad, Planta y equipos ($)', 
		emptyText: 'ingrese la cantidad en bienes', 
		id: 'prestador_ico_propiedad_planta_equipos', 
		name: 'prestador_ico_propiedad_planta_equipos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_propiedad_planta_equipos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese la cantidad en bienes',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var otrosActivos = new Ext.form.TextField( {
		fieldLabel: 'Otros Activos ($)', 
		emptyText: 'ingrese la cantidad de otros activos', 
		id: 'prestador_ico_otros_activos', 
		name: 'prestador_ico_otros_activos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_otros_activos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese la cantidad de otros activos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var pasivos = new Ext.form.TextField( {
		fieldLabel: 'Pasivos ($)', 
		emptyText: 'ingrese los pasivos', 
		id: 'prestador_ico_pasivos', 
		name: 'prestador_ico_pasivos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_pasivos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los pasivos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var pasivosCorrientes = new Ext.form.TextField( {
		fieldLabel: 'Pasivos Corrientes ($)', 
		emptyText: 'ingrese los pasivos corrientes', 
		id: 'prestador_ico_pasivos_corrientes', 
		name: 'prestador_ico_pasivos_corrientes', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_pasivos_corrientes')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los pasivos corrientes',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var obligacionesFinancieras = new Ext.form.TextField( { 
		fieldLabel: 'Obligaciones Financieras (Bancos o Similares) ($)', 
		emptyText: 'ingrese las obligaciones financieras', 
		id: 'prestador_ico_obligaciones_financieras', 
		name: 'prestador_ico_obligaciones_financieras', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_obligaciones_financieras')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese las obligaciones financieras',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var otrasCuentasPorPagar = new Ext.form.TextField( {
		fieldLabel: 'Otras Cuentas por Pagar (Proveedores) ($)', 
		emptyText: 'ingrese otras cuentas por pagar', 
		id: 'prestador_ico_otras_cuentas_por_pagar', 
		name: 'prestador_ico_otras_cuentas_por_pagar', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_otras_cuentas_por_pagar')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese otras cuentas por pagar',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var obligacionesLaborales = new Ext.form.TextField( {
		fieldLabel: 'Obligaciones Laborales y de Seguridad Social ($)', 
		emptyText: 'ingrese el valor de las obligaciones laborales', 
		id: 'prestador_ico_obligaciones_laborales', 
		name: 'prestador_ico_obligaciones_laborales', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_obligaciones_laborales')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese el valor de las obligaciones laborales',
			                trackMouse:true
						});
         	}
		}
	} );
		
	var otrosPasivos = new Ext.form.TextField( {
		fieldLabel: 'Otros Pasivos ($)', 
		emptyText: 'ingrese otros pasivos', 
		id: 'prestador_ico_otros_pasivos', 
		name: 'prestador_ico_otros_pasivos', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_otros_pasivos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese otros pasivos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var patrimonio = new Ext.form.TextField( {
		fieldLabel: 'Patrimonio ($)', 
		emptyText: 'ingrese el patrimonio', 
		id: 'prestador_ico_patrimonio', 
		name: 'prestador_ico_patrimonio', 
		anchor: '100%', 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_patrimonio')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese el patrimonio',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var financieraContableActivosPasivos = new Ext.Panel({
		autoWidth: true,
		frame: true,
		border: false,
		layout: 'column',
		//autoHeight: true,
		height: largo_panel,
		style: {"margin-right": Ext.isIE6 ? (Ext.isStrict ? "-10px" : "-13px") : "0" },
		items: [
		   {
				xtype: 'fieldset',
				border: false,
			    columnWidth: '1',
				id: servicio+'contablebalanceGeneral',
				defaultType: 'textfield',
				labelWidth: 210,
				defaults: {labelStyle: 'font-size:1.0em;'},
				bodyStyle: Ext.isIE ? 'padding:5 5 5px 15px;' : 'padding: 10px 10px;'
		   },
		   {
				xtype: 'fieldset',
				id: servicio+'contableactivos',
				columnWidth: '.495',
				height: 300,
				title: 'Activos',
				defaultType: 'textfield',
				labelWidth: 150,
				defaults: {labelStyle: 'font-size:1.0em;'},
				padding: 8,
				bodyStyle: Ext.isIE ? 'padding:5 5 5px 15px;' : 'padding: 10px 10px 10px 10px;'
			},
			{xtype: 'panel', columnWidth: '.01' },
		    {
				xtype: 'fieldset',
				id: servicio+'contablepasivos',
				title: 'Pasivos',
				columnWidth: '.495',
				height: 300,
				defaultType: 'textfield',
				labelWidth: 150,
				defaults: {labelStyle: 'font-size:1.0em;'},
				bodyStyle: Ext.isIE ? 'padding:5 5 5px 15px;' : 'padding: 10px 10px;'
			}
		],
		buttons:[
			{
				text: 'Atras', 
				id: 'prestador_boton_financiera_contable_activos_pasivos_atras', 
				iconCls: 'crear16', 
				handler: function(){
				}
			},
		    {
		    	text: 'Continuar', 
		    	id: 'prestador_boton_financiera_contable_activos_pasivos_continuar', 
		    	iconCls: 'crear16', 
		    	handler: function(){
		    					financieraContableActivosPasivos.hide();
		    					financieraContableTotales.show();
				}
		    }
		]
	});
	
	var estadoResultados = new Ext.form.TextField( { 
		fieldLabel: 'Estado de Resultados Entre Enero 1 y Diciembre 31 de', 
		emptyText: 'ingrese el año de los resultados',
		//anchor: '100%',
		id: 'prestador_ico_estado_de_resultados', 
		name: 'prestador_ico_estado_de_resultados', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_estado_de_resultados')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese el año de los resultados',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var totalIngresos = new Ext.form.TextField( {
		fieldLabel: 'Total de Ingresos ($)', 
		emptyText: 'ingrese el total de ingresos',
		anchor: '100%',
		id: 'prestador_ico_total_ingresos', 
		name: 'prestador_ico_total_ingresos', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_total_ingresos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese el año de los ingresos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var ingresosOperacionales = new Ext.form.TextField( {
		fieldLabel: 'Ingresos Operacionales ($)', 
		emptyText: 'ingrese los ingresos operacionales',
		anchor: '100%',
		id: 'prestador_ico_ingresos_operacionales', 
		name: 'prestador_ico_ingresos_operacionales', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_ingresos_operacionales')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'Ingrese los ingresos operacionales',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var ingresosNoOperacionales = new Ext.form.TextField( {
		fieldLabel: 'Ingresos No Operacionales ($)', 
		emptyText: 'ingrese los ingresos no operacionales',
		anchor: '100%',
		id: 'prestador_ico_ingresos_no_operacionales', 
		name: 'prestador_ico_ingresos_no_operacionales', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_ingresos_no_operacionales')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese los ingresos no operacionales',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var totalEgresos = new Ext.form.TextField( {
		fieldLabel: 'Total de Egresos ($)', 
		emptyText: 'ingrese el total de egresos',
		anchor: '100%',
		id: 'prestador_ico_total_egresos', 
		name: 'prestador_ico_total_egresos', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_total_egresos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese el total de egresos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var gastosAdministrativos = new Ext.form.TextField( { 
		fieldLabel: 'Gastos Administrativos ($)', 
		emptyText: 'ingrese los gastos administrativos',
		anchor: '100%',
		id: 'prestador_ico_gastos_administrativos', 
		name: 'prestador_ico_gastos_administrativos', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_gastos_administrativos')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese los gastos administrativos',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var costosOperacionMantenimiento = new Ext.form.TextField( {
		fieldLabel: 'Costos de Operacion y Mantenimiento ($)', 
		emptyText: 'ingrese los costos de operacion y mantenimiento',
		anchor: '100%',
		id: 'prestador_ico_costo_operacion_mantenimiento', 
		name: 'prestador_ico_costo_operacion_mantenimiento', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_costo_operacion_mantenimiento')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese los costos de operacion y mantenimiento',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var costosInversion = new Ext.form.TextField( {
		fieldLabel: 'Costos de Inversion ($)', 
		emptyText: 'ingrese los costos de inversion',
		anchor: '100%',
		id: 'prestador_ico_costo_inversion', 
		name: 'prestador_ico_costo_inversion', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_costo_inversion')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese los costos de inversion',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var resultadosEjercicio = new Ext.form.TextField( {
		fieldLabel: 'Resultados del Ejercicio ($)', 
		emptyText: 'ingrese los resultados del ejercicio',
		anchor: '100%',
		id: 'prestador_ico_resultados_ejecicio', 
		name: 'prestador_ico_resultados_ejecicio', 
		width: 300, 
		allowBlank: false,
		listeners: {
            'render': function(){ 
						new Ext.ToolTip({
			                target: (Ext.getCmp('prestador_ico_resultados_ejecicio')).getEl(),
			                title: 'Ayuda rapida',
			                anchor: 'top',
			                html: 'ingrese los resultados del ejercicio',
			                trackMouse:true
						});
         	}
		}
	} );
	
	var financieraContableTotales = new Ext.Panel({
		hidden: true,
		autoWidth: true,
		frame: true,
		border: false,
		layout: 'column',
		//autoHeight: true,
		height: largo_panel,
		style: {"margin-right": Ext.isIE6 ? (Ext.isStrict ? "-10px" : "-13px") : "0" },
		items: [
		   {
				xtype: 'fieldset',
				title: 'Resultados Totales',
			    columnWidth: '1',
				id: servicio+'contabletotales',
				defaultType: 'textfield',
				labelWidth: 310,
				defaults: {labelStyle: 'font-size:1.0em;'},
				bodyStyle: Ext.isIE ? 'padding:5 5 5px 15px;' : 'padding: 10px 10px;'
		   }
		],
		buttons:[
			{
				text: 'Atras', 
				id: 'prestador_boton_financiera_contable_totales_atras', 
				iconCls: 'crear16', 
				handler: function(){
								financieraContableTotales.hide();
								financieraContableActivosPasivos.show();
				}
			},
		    {
		    	text: 'Continuar', 
		    	id: 'prestador_boton_financiera_contable_totales_continuar', 
		    	iconCls: 'crear16', 
		    	handler: function(){
								subirDatos();
				}
		    }
		]
	});
	
	var financieraContable = new Ext.Panel({
		title: 'Informacion Contable',
		autoWidth: true,
		autoHeight: true,
		items: [financieraContableActivosPasivos, financieraContableTotales]
	});
	
	if( servicio == 'acueducto'){
		Ext.getCmp(servicio+'contablebalanceGeneral').add( balanceGeneral );
		Ext.getCmp(servicio+'contableactivos').add( [activos, activosCorrientes, efectivo, deudores, inventario, activosFijos, propiedadPlantaEquipo, otrosActivos] );
		Ext.getCmp(servicio+'contablepasivos').add( [pasivos, pasivosCorrientes, obligacionesFinancieras, otrasCuentasPorPagar, obligacionesLaborales, otrosPasivos, patrimonio] );
		Ext.getCmp(servicio+'contabletotales').add( [estadoResultados, totalIngresos, ingresosOperacionales, ingresosNoOperacionales, totalEgresos, gastosAdministrativos, costosOperacionMantenimiento, costosInversion, resultadosEjercicio] );
	}
	
	function subirDatos() {
		Ext.example.msg('Aviso', 'Subir datos!!!');
	}

	return financieraContable;
}