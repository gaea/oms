<?php

include_once('getid3/getid3.php');
include_once(GETID3_INCLUDEPATH.'getid3.functions.php'); // Function library

/**
 * gestionar_cancion actions.
 *
 * @package    oms
 * @subpackage gestionar_cancion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestionar_cancionActions extends sfActions
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

  public function executeCrearCancion(sfWebRequest $request)
  {
	$salida	='';

	try
	{  
		$nombre_carpeta = "uploads";
	
		if(!is_dir($nombre_carpeta))
		{
			mkdir($nombre_carpeta, 0777, true);
		}
		
		sleep(2);
	
		$nombre = $_FILES['can_archivo']['name'];//$iv_nombre;//
		$tamano = $_FILES['can_archivo']['size'];
		$tipo = $_FILES['can_archivo']['type'];
		$temporal = $_FILES['can_archivo']['tmp_name'];
	
		if(file_exists($nombre_carpeta."/".$nombre))
		{
			$salida = "({success: false, errors: { reason: 'Ya existe el archivo con el mismo nombre en la base de datos'}})";
		}
		else
		{
			/*if($tamano > 2100000)//$tamano > algo 1000000 aprox 1mega
			{
				$salida = "({success: false, errors: { reason: 'El archivo exede el limite de tamano'}})";
			}
			else
			{*/
				
			$copio=copy($temporal, "uploads/".$nombre);
			
			if($copio)
			{
				$atributos_cancion = GetAllMP3info($temporal);
				//playtime_string, fileformat
				$cancion = new Cancion();
				$cancion->setNombre($atributos_cancion['id3']['id3v1']['title']);//$cancion->setNombre($this->getRequestParameter('can_nombre'));//
				$cancion->setAutor($atributos_cancion['id3']['id3v1']['artist']);//$cancion->setAutor($this->getRequestParameter('can_autor'));
				$cancion->setAlbum($atributos_cancion['id3']['id3v1']['album']);//$cancion->setAlbum($this->getRequestParameter('can_album'));
				$cancion->setFechaDePublicacion($atributos_cancion['id3']['id3v1']['year']);//$cancion->setFechaDePublicacion($this->getRequestParameter('can_fecha_de_publicacion'));
				$cancion->setDuracion($atributos_cancion['playtime_string']);//$cancion->setDuracion($this->getRequestParameter('can_duracion'));
				$cancion->setUrl("uploads/".$nombre);
				$cancion->setHabilitada($this->getRequestParameter('can_habilitada'));
				$cancion->setPrecio($this->getRequestParameter('can_precio'));
				$cancion->setRanking($this->getRequestParameter('can_ranking'));
				$cancion->save();	
				
				$salida = "({success: true, mensaje:'La canci&oacute;n fue creada exitosamente'})";
				return $this->renderText($salida);
			}
			else
			{
				$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
			}
			
			//}
		}
	}
	catch (Exception $excepcion)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
		return $this->renderText($salida);
	}
	 		
	return $this->renderText($salida);
  }
  
	/**
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion actualiza una Cancions
	 */
	public function executeActualizarCancion(sfWebRequest $request)
	{
		$salida = '';

		try
		{
			$can_codigo = $this->getRequestParameter('codigo_cancion');

			$cancion  = CancionPeer::retrieveByPk($can_codigo);
				
			if($cancion)
			{
				$cancion->setNombre($this->getRequestParameter('can_nombre'));
				$cancion->setAutor($this->getRequestParameter('can_autor'));
				$cancion->setAlbum($this->getRequestParameter('can_album'));
				$cancion->setFechaDePublicacion($this->getRequestParameter('can_fecha_de_publicacion'));
				$cancion->setDuracion($this->getRequestParameter('can_duracion'));
				//$cancion->setUrl($this->getRequestParameter('can_url'));
				$cancion->setHabilitada($this->getRequestParameter('can_habilitada'));
				$cancion->setPrecio($this->getRequestParameter('can_precio'));
				$cancion->setRanking($this->getRequestParameter('can_ranking'));

				$cancion->save();
			}
			
			$salida = "({success: true, mensaje:'La canci&oacute;n fue actualizada exitosamente'})";
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}

		return $this->renderText($salida);
	}
	/**
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion devuelve un listado de canciones
	 */
	public function executeListarCancion(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		
		try
		{
			$conexion = new Criteria();

			if($buscar != '')
			{
				$c1 = $conexion->getNewCriterion(CancionPeer::ALBUM, '%'.$buscar.'%', Criteria::LIKE);
				$c2 = $conexion->getNewCriterion(CancionPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
				$c3 = $conexion->getNewCriterion(CancionPeer::AUTOR, '%'.$buscar.'%', Criteria::LIKE);
				//$c4 = $conexion->getNewCriterion(CancionPeer::DURACION, $buscar, Criteria::LIKE);
				//$c5 = $conexion->getNewCriterion(CancionPeer::FECHA_DE_PUBLICACION, $buscar, Criteria::LIKE);
				//$c6 = $conexion->getNewCriterion(CancionPeer::CODIGO, $buscar, Criteria::LIKE);
				//$c7 = $conexion->getNewCriterion(CancionPeer::PRECIO, $buscar, Criteria::LIKE);
				//$c8 = $conexion->getNewCriterion(CancionPeer::RANKING, $buscar, Criteria::LIKE);
				//$c7->addOr($c8);
				//$c6->addOr($c7);
				//$c5->addOr($c6);
				//$c4->addOr($c5);
				//$c3->addOr($c4);
				$c2->addOr($c3);
				$c1->addOr($c2);
				
				$conexion->add($c1);
			}
			
			$numero_canciones = CancionPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$cancion = CancionPeer::doSelect($conexion);

			foreach($cancion as $temporal)
			{
				$datos[$fila]['can_codigo'] = $temporal->getCodigo();
				$datos[$fila]['can_nombre'] = $temporal->getNombre();
				$datos[$fila]['can_autor'] = $temporal->getAutor();
				$datos[$fila]['can_album'] = $temporal->getAlbum();
				$datos[$fila]['can_fecha_de_publicacion'] = $temporal->getFechaDePublicacion();
				$datos[$fila]['can_duracion'] = $temporal->getDuracion();
				$datos[$fila]['can_url'] = $temporal->getUrl();
				$datos[$fila]['can_precio'] = $temporal->getPrecio();
				$datos[$fila]['can_habilitada'] = $temporal->getHabilitada();
				$datos[$fila]['can_ranking'] = $temporal->getRanking();

				$fila++;
			}
			if($fila>0)
			{
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}

		}
		catch (Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}

	/**
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion elimina una Cancions
	 */
	public function executeEliminarCancion(sfWebRequest $request)
	{
		$salida = '';

		try
		{

			$can_codigo = $this->getUser()->getAttribute('can_codigo');
				
			$cancion;
			$cancion  = CancionPeer::retrieveByPk($can_codigo);
	
			if($cancion)
			{
				$cancion->delete();
				$salida = "({success: true, mensaje:'La Canci&oacute;n fue eliminada exitosamente'})";
			}
			
			if(!$cancion)
			{
				$salida = "({success: true, mensaje:'No se encontro la Canci&oacute;n en el sistema'})";
			}
			
			if($codigo_cancion=='')
			{
				$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna Canci&oacute;n'}})";
			}
				
		}
		catch (Exception $exception)
		{
				
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n al tratar de eliminar ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
}
