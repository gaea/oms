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
		//echo 'header("Cache-Control: no-cache, must-revalidate")';
		$this->valor = $this->getUser()->getAttribute('codigo_usuario');
		$this->crearCanalRSS($request);
		$this->crearCanalRSSCunia($request);
	}
	
	public function executePublicarMensaje(sfWebRequest $request)
	{
		//$codigo_usuario = 2;
		$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
		$filename  = "mensajes/".$codigo_usuario.".txt";
		//$filename  = "/var/www/oms/web/mensajes/".$codigo_usuario.".txt";

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
		flush();
		return $this->renderText(json_encode($response));
	}
  
	public function crearCanalRSSCunia(sfWebRequest $request)
	{
		try
		{
			$timeZone = new DateTimeZone('America/Bogota');
			$hoy = new DateTime("NOW", $timeZone);
			$hoy = $hoy->format('Y-m-d');
			
			$conexion = new Criteria();
			$conexion->add(ProgramacionCunaPeer::FECHA, $hoy);
			$programaciones = ProgramacionCunaPeer::doSelect($conexion);
			
			$file = fopen("rss/cunias.xml",'w');
			
			fwrite($file, "<?xml version=\"1.0\" ?>\n");
			fwrite($file, "<rss version=\"2.0\">\n");
			fwrite($file, "\t<channel>\n");
			fwrite($file, "\t\t<title>OMS</title>\n");
			fwrite($file, "\t\t<link>http://localhost/www/oms/web/oms_user.php/interfaz_cliente</link>\n");
			fwrite($file, "\t\t<description>Open Music Suscriptores...</description>\n");
			fwrite($file, "\t\t<image>\n");
			fwrite($file, "\t\t\t<url>http://localhost/www/oms/web/images/oms.png</url> \n");
			fwrite($file, "\t\t\t<link>http://localhost/www/oms/web/oms_user.php/interfaz_cliente</link> \n"); // ojo que esta url hay que cambiarla
			fwrite($file, "\t\t</image>\n");

			if($programaciones)
			{
				foreach($programaciones as $programacion)
				{
					fwrite($file, "\t\t<item>\n");
					
					$cunia = CuniaComercialPeer::retrieveByPK($programacion->getCuniaComercial());
				
					//fwrite($file, "\t\t\t".$temporal->getCancion()."\n");
					fwrite($file, "\t\t\t<title><![CDATA[".$cunia->getNombre()."]]></title>\n");
					fwrite($file, "\t\t\t<link>http://localhost/www/oms/web/".$cunia->getUrl()."</link>\n");
					fwrite($file, "\t\t\t<enclosure url=\"http://localhost/www/oms/web/".$cunia->getUrl()."\" length=\"".filesize("/home/legnardz/www/www/oms/web/".$cunia->getUrl())."\" type=\"audio/mpeg\" />\n");
					fwrite($file, "\t\t\t<description>\n");
					//fwrite($file, "\t\t\t\t<![CDATA[\n");
					fwrite($file, "Duracion: ".$cunia->getDuracion()."\n");
					//fwrite($file, "\t\t\t\t]]>\n");
					fwrite($file, "\t\t\t</description>\n");
					fwrite($file, "\t\t\t<pubDate>".$programacion->getFecha()." ".$programacion->getInicio()."</pubDate>\n");
					fwrite($file, "\t\t</item>\n");
				}
			}
			
			fwrite($file, "\t</channel>\n");
			fwrite($file, "</rss>\n");
			
			fclose($file);
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al crear el canal rss para cunia ' , error: '".$exception->getMessage()."'}})";
			//return $this->renderText($salida);
		}
		
		$salida = "({success: true, mensaje:'El canal rss para cunia fue creado exitosamente'})";
		//return $this->renderText($salida);
	}
	
	
	public function crearCanalRSS(sfWebRequest $request)
	{
		try
		{
			//$codigo_usuario = 2;
			$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
			$conexion = new Criteria();
			
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			
			$numero_canciones = ProgramacionCancionPeer::doCount($conexion);
			$programacion = ProgramacionCancionPeer::doSelect($conexion);
			
			$file = fopen("rss/".$codigo_usuario.".xml",'w');
			
			fwrite($file, "<?xml version=\"1.0\" ?>\n");
			fwrite($file, "<rss version=\"2.0\">\n");
			fwrite($file, "\t<channel>\n");
			fwrite($file, "\t\t<title>OMS</title>\n");
			fwrite($file, "\t\t<link>http://localhost/www/oms/web/oms_user.php/interfaz_cliente</link>\n");
			fwrite($file, "\t\t<description>Open Music Suscriptores...</description>\n");
			fwrite($file, "\t\t<image>\n");
			fwrite($file, "\t\t\t<url>http://localhost/www/oms/web/images/oms.png</url> \n");
			fwrite($file, "\t\t\t<link>http://localhost/www/oms/web/oms_user.php/interfaz_cliente</link> \n"); // ojo que esta url hay que cambiarla
			fwrite($file, "\t\t</image>\n");

			if($programacion)
			{
				foreach($programacion as $temporal)
				{
					fwrite($file, "\t\t<item>\n");
					
					$cancion = CancionPeer::retrieveByPk($temporal->getCancion());
				
					//fwrite($file, "\t\t\t".$temporal->getCancion()."\n");
					fwrite($file, "\t\t\t<title><![CDATA[".$cancion->getNombre()."]]></title>\n");
					fwrite($file, "\t\t\t<link>http://localhost/www/oms/web/".$cancion->getUrl()."</link>\n");
					fwrite($file, "\t\t\t<enclosure url=\"http://localhost/www/oms/web/".$cancion->getUrl()."\" length=\"".filesize("/home/legnardz/www/www/oms/web/".$cancion->getUrl())."\" type=\"audio/mpeg\" />\n");
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
			//return $this->renderText($salida);
		}
		
		$salida = "({success: true, mensaje:'El canal rss fue creado exitosamente'})";
		//return $this->renderText($salida);
	}
	
	
	
}
