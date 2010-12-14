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
	
	public function executePublicarMensaje(sfWebRequest $request)
	{
		
		$filename  = '../mensajes/2.txt';
		
		// store new message in the file
		$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
		if ($msg != '')
		{
		  file_put_contents($filename,$msg);
		  die();
		}

		// infinite loop until the data file is not modified
		$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
		$currentmodif = filemtime($filename);
		while ($currentmodif <= $lastmodif) // check if the data file has been modified
		{
		  usleep(10000); // sleep 10ms to unload the CPU
		  clearstatcache();
		  $currentmodif = filemtime($filename);
		}

		// return a json array
		$response = array();
		$response['msg']       = file_get_contents($filename);
		$response['timestamp'] = $currentmodif;

		return $this->renderText(json_encode($response));
	}
  
	public function executeCrearCanalRSS(sfWebRequest $request)
	{
		try
		{
			$codigo_usuario = 2;
			//$codigo_usuario = $this->getUser()->setAttribute('codigo_usuario');
			$conexion = new Criteria();
			
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			
			$numero_canciones = ProgramacionCancionPeer::doCount($conexion);
			$programacion = ProgramacionCancionPeer::doSelect($conexion);
			
			$file = fopen("/var/www/oms/web/rss/".$codigo_usuario.".xml",'w');
			
			fwrite($file, "<?xml version=\"1.0\" ?>\n");
			fwrite($file, "<rss version=\"2.0\">\n");
			fwrite($file, "\t<channel>\n");
			fwrite($file, "\t\t<title>OMS</title>\n");
			fwrite($file, "\t\t<link>http://localhost/oms/web/oms_user.php/interfaz_cliente</link>\n");
			fwrite($file, "\t\t<description>Open Music Suscriptor...</description>\n");
			fwrite($file, "\t\t<image>\n");
			fwrite($file, "\t\t\t<url>http://localhost/oms/web/images/oms.png</url> \n");
			fwrite($file, "\t\t\t<link>http://localhost/oms/web/oms_user.php/interfaz_cliente</link> \n"); // ojo que esta url hay que cambiarla
			fwrite($file, "\t\t</image>\n");

			if($programacion)
			{
				foreach($programacion as $temporal)
				{
					fwrite($file, "\t\t<item>\n");
					
					$cancion = CancionPeer::retrieveByPk($temporal->getCancion());
				
					//fwrite($file, "\t\t\t".$temporal->getCancion()."\n");
					fwrite($file, "\t\t\t<title><![CDATA[".$cancion->getNombre()."]]></title>\n");
					fwrite($file, "\t\t\t<link>http://localhost/oms/web/".$cancion->getUrl()."</link>\n");
					fwrite($file, "\t\t\t<enclosure url=\"http://localhost/oms/web/".$cancion->getUrl()."\" length=\"".filesize("/var/www/oms/web/".$cancion->getUrl())."\" type=\"audio/mpeg\" />\n");
					fwrite($file, "\t\t\t<description>\n");
					//fwrite($file, "\t\t\t\t<![CDATA[\n");
					fwrite($file, "\t\t\t\t\tAlbum: ".$cancion->getAlbum()."\n");
					fwrite($file, "Duracion: ".$cancion->getDuracion()."\n");
					//fwrite($file, "\t\t\t\t]]>\n");
					fwrite($file, "\t\t\t</description>\n");
					fwrite($file, "\t\t\t<pubDate>".$temporal->getFecha()." ".$temporal->getInicio()."</pubDate>\n");
					fwrite($file, "\t\t</item>\n");
				}
			}
			
			fwrite($file, "\t</channel>\n");
			fwrite($file, "</rss>\n");
			
			fclose($file);
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al crear el canal rss ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
		
		$salida = "({success: true, mensaje:'El canal rss fue creado exitosamente'})";
		return $this->renderText($salida);
	}
}
