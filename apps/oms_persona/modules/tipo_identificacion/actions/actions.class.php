<?php

/**
 * tipo_identificacion actions.
 *
 * @package    oms
 * @subpackage tipo_identificacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipo_identificacionActions extends sfActions
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
  
  public function executeListarTipos(){
	  $salida='({"total":"0", "results":""})';
	  $datos;
	  $fila = 0;
	  
	  try
	  {  
		  $criterio = new Criteria();
		  $tipos = TipoIdentificacionPeer::doSelect($criterio);
		  
		  foreach($tipos As $tipo)
		  {
			  $datos[$fila]['tipoId_codigo'] = $tipo->getCodigo();
			  $datos[$fila]['tipoId_nombre'] = $tipo->getNombre();
			  $datos[$fila++]['tipoId_descripcion'] = $tipo->getDescripcion();
		  }
		  
		  if($fila>0)
		  {
			  $jsonresult = json_encode($datos);
			  $salida = '({"total":"'.$fila.'","results":'.$jsonresult.'})';
		  }
	  }
	  catch (Exception $exception)
	  {
		  $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})");
	  }
	  
	  return $this->renderText($salida);
  }
}
