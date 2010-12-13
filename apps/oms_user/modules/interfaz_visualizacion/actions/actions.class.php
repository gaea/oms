<?php

/**
 * interfaz_visualizacion actions.
 *
 * @package    oms
 * @subpackage interfaz_visualizacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class interfaz_visualizacionActions extends sfActions
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
  
	public function executeCrearCanalRSS(sfWebRequest $request)
	{
		try
		{
			$codigo_usuario = 2;
			
			$conexion = new Criteria();
			
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			
			$numero_canciones = ProgramacionCancionPeer::doCount($conexion);
			$programacion = ProgramacionCancionPeer::doSelect($conexion);
			
			$file = fopen("/var/www/oms/web/rss/".$codigo_usuario.".xml",'w');

			if($programacion)
			{
				foreach($programacion as $temporal)
				{
					$cancion = CancionPeer::retrieveByPk($temporal->getCancion());
				
					fwrite($file, $temporal->getCancion()."\n");
					fwrite($file, $cancion->getNombre()."\n");
					fwrite($file, $temporal->getFecha()."\n");
					fwrite($file, $cancion->getDuracion()."\n");
					fwrite($file, $cancion->getUrl()."\n");
					fwrite($file, $temporal->getInicio()."\n");
				}
			}
			
			fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Grid</title><link rel='stylesheet' type='text/css' href='printstyle.css'/></head>");
			fwrite($file, "<body><table summary='Presidents List'><caption>The Presidents of the United States</caption><thead><tr><th scope='col'>First Name</th><th scope='col'>Last Name</th><th scope='col'>Party</th><th scope='col'>Entering Office</th><th scope='col'>Leaving Office</th><th scope='col'>Income</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='4'>");
			fwrite($file, $numero_canciones);
			fwrite($file, " presidents</td></tr></tfoot><tbody>");
			fwrite($file, "</tbody></table></body></html>");  
			fclose($file);
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
		
		$salida = "({success: true, mensaje:'La canci&oacute;n fue actualizada exitosamente'})";
		return $this->renderText($salida);
	}
}
