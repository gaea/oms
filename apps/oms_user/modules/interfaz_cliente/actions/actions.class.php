<?php

/**
 * interfaz_cliente actions.
 *
 * @package    oms
 * @subpackage interfaz_cliente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class interfaz_clienteActions extends sfActions
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
  
  public function executeListarCancion()
  {
	  $salida='({"total":"0", "results":""})';
	  $fila=0;
	  $datos;
	  
	  $codigoUsr = $this->getUser()->getAttribute('codigo_usuario');
	  
	  if( $codigoUsr!=null )
	  {
		  $usuario = UsuarioPeer::retrieveByPK($codigoUsr);
		  
		  if( $usuario->esCliente() )
		  {
			  $canciones = $usuario->getCancionesMes();
			  
			  if($canciones)
			  {
				  foreach($canciones as $cancion)
				  {
					  $datos[$fila]['cancion_codigo'] = $cancion->getCodigo();
					  $datos[$fila]['cancion_nombre'] = $cancion->getNombre();
					  $datos[$fila]['cancion_autor'] = $cancion->getAutor();
					  
					  $datos[$fila]['cancion_album'] = $cancion->getAlbum();
					  $datos[$fila]['cancion_duracion'] = $cancion->getDuracion();
					  $datos[$fila++]['cancion_fecha_publicacion'] = $cancion->getFechaDePublicacion();
				  }
				  
				  if($fila>0)
				  {
					$jsonresult = json_encode($datos);
					$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
				  }
			  }
			  
		  }
		  else
		  {
			  return $this->renderText("({success: false, errors: { reason: 'El usuario autenticado no es un cliente'}})");
		  }
	  }
	  else
	  {
		  return $this->renderText("({success: false, errors: { reason: 'No hay usuario autenticado'}})");
	  }
	  
	  return $this->renderText($salida);
  }
  
  public function executeListarCunia()
  {
	  $salida='({"total":"0", "results":""})';
	  $fila=0;
	  $datos;
	  
	  $codigoUsr = $this->getUser()->getAttribute('codigo_usuario');
	  
	  if( $codigoUsr!=null )
	  {
		  $usuario = UsuarioPeer::retrieveByPK($codigoUsr);
		  
		  if( $usuario->esCliente() )
		  {
			  $cunias = $usuario->getCuniaComercialsMes();
			  
			  if($cunias)
			  {
				  foreach($cunias as $cunia)
				  {
					  $datos[$fila]['cunia_codigo'] = $cunia->getCodigo();
					  $datos[$fila]['cunia_nombre'] = $cunia->getNombre();
					  $datos[$fila]['cunia_duracion'] = $cunia->getDuracion();
					  $datos[$fila]['cunia_creacion'] = $cunia->getFechaCreacion();
					  $datos[$fila++]['cunia_usuario'] = $cunia->getUsuario();
				  }
				  
				  if($fila>0)
				  {
					$jsonresult = json_encode($datos);
					$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
				  }
			  }
			  
		  }
		  else
		  {
			  return $this->renderText("({success: false, errors: { reason: 'El usuario autenticado no es un cliente'}})");
		  }
	  }
	  else
	  {
		  return $this->renderText("({success: false, errors: { reason: 'No hay usuario autenticado'}})");
	  }
	  
	  return $this->renderText($salida);
  }
  
  public function executeListarFacturar()
  {
	  $codigoUsr = $this->getUser()->getAttribute('codigo_usuario');
	  
	  if( $codigoUsr!=null )
	  {
		  $usuario = UsuarioPeer::retrieveByPK($codigoUsr);
		  
		  if( $usuario->esCliente() )
		  {
			  $factCancion = $usuario->getFacturaCancionMes();
			  $factCunia = $usuario->getFacturaCuniaMes();
			  $factTotal = $usuario->getFacturaMes();
			  
			  return  $this->renderText("({success: true, mensaje:{factura:{canciones:'".$factCancion."', cunias:'".$factCunia."', total:'".$factTotal."'}}})");
		  }
		  else
		  {
			  return $this->renderText("({success: false, errors: { reason: 'El usuario autenticado no es un cliente'}})");
		  }
	  }
	  else
	  {
		  return $this->renderText("({success: false, errors: { reason: 'No hay usuario autenticado'}})");
	  }
  }
  
  
}
