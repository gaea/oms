<?php


/**
 * Skeleton subclass for performing query and update operations on the 'venta' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Nov 22 16:46:14 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class VentaPeer extends BaseVentaPeer {

	/*
	 * ventas del mes actual
	 * fecha mayor o igual al primer dia del presente mes
	 * */
	public static function doSelectMesActual(){
		$timeZone = new DateTimeZone('America/Bogota');
		$hoy = new DateTime("NOW", $timeZone);
		$mes = $hoy->format('m');
		$anio = $hoy->format('Y');
		$inicio = $anio."-".$mes."-"."01";
		//SELECT EXTRACT(MONTH FROM TIMESTAMP '2009-11-06 17:05:01'); --> 11
		//SELECT TIMESTAMP WITH TIME ZONE 'now';
		
		$criterio = new Criteria();
		$criterio->add(self::FECHA_VENTA, $inicio, Criteria::GREATER_EQUAL);
		
		$ventas = self::doSelect($criterio);
		
		return $ventas;
		
	}
	
	/*
	 * ventas del mes actual
	 * fecha mayor o igual al primer dia del presente mes
	 * */
	public static function doSelectMesActualUsuario( $codigo_usuario ){
		$timeZone = new DateTimeZone('America/Bogota');
		$hoy = new DateTime("NOW", $timeZone);
		$mes = $hoy->format('m');
		$anio = $hoy->format('Y');
		$inicio = $anio."-".$mes."-"."01";
		//SELECT EXTRACT(MONTH FROM TIMESTAMP '2009-11-06 17:05:01'); --> 11
		//SELECT TIMESTAMP WITH TIME ZONE 'now';
		
		$criterio = new Criteria();
		$criterio->add(self::FECHA_VENTA, $inicio, Criteria::GREATER_EQUAL);
		$criterio->add(self::USUARIO, $inicio, $codigo_usuario);
		
		$ventas = self::doSelect($criterio);
		
		return $ventas;
		
	}
	

} // VentaPeer
