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

	$codigo_usuario = $this->getRequestParameter('codigo_usuario');
	$salida = "La factura no pudo ser consultada";
	$factura = "";
	
	try
	{	
		// aqui genera la  factura
		$factura = "Bienvenido a OMS \n\n\tUsuario: pepito\n\tCanciones: lista canciones\n\tCunias: lista cunias\n\n\tValor total: $243546";
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
