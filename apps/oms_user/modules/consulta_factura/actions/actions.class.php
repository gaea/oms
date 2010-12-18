<?php

/**
 * consulta_factura actions.
 *
 * @package    oms
 * @subpackage consulta_factura
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class consulta_facturaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  
  public function executeConsultaMovil(sfWebRequest $request)
  {

	//$codigo_usuario = $this->getRequestParameter('codigo_usuario');
	$usuario = $this->getRequestParameter('usuario');
	//$password = $this->getRequestParameter('password');
	$salida = "La factura no pudo ser consultada";
	$factura = "";
	
	try
	{	
		$usuario = UsuarioPeer::doSelectOneCliente($usuario);
		
		if($usuario)
		{
			$factura = "Bienvenido a OMS \n\n";
			$factura .= "Factura de Consulta Mobil \n\n ";
			$factura .= "\tUsuario: ".$usuario->getUsuario()."\n\n ";
			$timeZone = new DateTimeZone('America/Bogota');
			$hoy = new DateTime("NOW", $timeZone);
			$hoy = $hoy->format('Y-m-d');
			$factura .= "\tFecha: ".$hoy."\n\n ";
			$factura .= "\tNumero Canciones: ".$usuario->getNumeroCancionesMes()."\n ";
			$factura .= "\tNumero Cunas: ".$usuario->getNumeroCuniaComercialsMes()."\n\n ";
			$factura .= "\tValor total: ".$usuario->getFacturaMes();
			
		}
		// aqui genera la  factura
		//$factura = "\n\n\tFecha: 13-12-2010\n\n\tValor total: $243546";
		return $this->renderText($factura);
	}
	catch (Exception $exception)
	{
		$salida= " Error: ".$exception->getMessage();
		return $this->renderText($salida);
	}
  
	return $this->renderText($salida);
  }
}
