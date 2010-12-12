<?php


/**
 * Skeleton subclass for performing query and update operations on the 'venta_cunia_comercial' table.
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
class VentaCuniaComercialPeer extends BaseVentaCuniaComercialPeer {
	
	/*
	 * cunias del mes actual de un usuario
	 * fecha mayor o igual al primer dia del presente mes
	 * */
	public static function doSelectMesActualUsuario( $codigo_usuario ){
		$timeZone = new DateTimeZone('America/Bogota');
		$hoy = new DateTime("NOW", $timeZone);
		$mes = $hoy->format('m');
		$anio = $hoy->format('Y');
		$inicio = $anio."-".$mes."-"."01";
		
		$criterio = new Criteria();
		$criterio->addJoin(self::VENTA, VentaPeer::CODIGO);
		$criterio->add(VentaPeer::FECHA_VENTA, $inicio, Criteria::GREATER_EQUAL);
		$criterio->add(VentaPeer::USUARIO, $codigo_usuario);
		
		$ventas_cunia = self::doSelect($criterio);
		
		return $ventas_cunia;
	}

} // VentaCuniaComercialPeer
