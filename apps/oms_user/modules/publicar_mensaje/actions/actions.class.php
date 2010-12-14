<?php

/**
 * publicar_mensaje actions.
 *
 * @package    oms
 * @subpackage publicar_mensaje
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class publicar_mensajeActions extends sfActions
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
  
	public function executePublicarMensaje(sfWebRequest $request)
	{
		try
		{
			$codigo_usuario = 2;
			//$codigo_usuario = $this->getUser()->setAttribute('codigo_usuario');
			
			$mensaje = $this->getRequestParameter('mensaje');
			
			$file = fopen("/var/www/oms/web/mensajes/".$codigo_usuario.".txt",'w');
			
			fwrite($file, $mensaje);
			
			fclose($file);
			
			/*if ($mensaje != '')
			{
			  file_put_contents("/var/www/oms/web/mensajes/".$codigo_usuario.".txt",$mensaje);
			  die();
			}*/
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al publicar el mensaje' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
		
		$salida = "({success: true, mensaje:'El mensaje fue publicado exitosamente'})";
		return $this->renderText($salida);
	}
}
