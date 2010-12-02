<?php

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


 /**
 *Aqui se crea un doc
 */ 
  public function executeCrearCancion()
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
		//echo(1);
		$nombre = $_FILES['archivo']['name'];//$iv_nombre;//
		$tamano = $_FILES['archivo']['size'];
		$tipo = $_FILES['archivo']['type'];
		$temporal = $_FILES['archivo']['tmp_name'];
		
		if(file_exists($nombre_carpeta."/".$nombre))
		{
			$salida = "({success: false, errors: { reason: 'Ya existe el archivo con el mismo nombre en la base de datos'}})";
		}
		else
		{
			if($tamano > 2100000)//$tamano > algo 1000000 aprox 1mega
			{
				$salida = "({success: false, errors: { reason: 'El archivo exede el limite de tamano'}})";
			}
			else
			{
				
				$copio=copy($temporal, "uploads/".$nombre);
				
				if($copio){
				$cancion = new Cancion();
				$cancion->setNombre($this->getRequestParameter('can_nombre'));
				$cancion->setAutor($this->getRequestParameter('can_autor'));
				$cancion->setAlbum($this->getRequestParameter('can_album'));
				$cancion->setFechaDePublicacion($this->getRequestParameter('can_fecha_de_publicacion'));
				$cancion->setDuracion($this->getRequestParameter('can_duracion'));
				$cancion->setUrl($this->getRequestParameter('can_url'));
				$cancion->setHabilitada($this->getRequestParameter('can_habilitada'));
				$cancion->setPrecio($this->getRequestParameter('can_precio'));
				$cancion->setRanking($this->getRequestParameter('can_ranking'));

				$cancion->save();		
				$salida = "({success: true, mensaje:'La canci&oacute;n fue creada exitosamente'})";
				return $this->renderText($salida);
				}
			}
		}
	}
	catch (Exception $excepcion)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
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

		try{
			$can_codigo = $this->getUser()->getAttribute('can_codigo');
			$cancion;
				
			if($can_codigo!=''){
				$cancion  = CancionsPeer::retrieveByPk($can_codigo);
			}
			else
			{
				$cancion = new Cancion();
			}
				
			if($cancion)
			{
				$cancion->setNombre($this->getRequestParameter('can_nombre'));
				$cancion->setAutor($this->getRequestParameter('can_autor'));
				$cancion->setAlbum($this->getRequestParameter('can_album'));
				$cancion->setFechaDePublicacion($this->getRequestParameter('can_fecha_de_publicacion'));
				$cancion->setDuracion($this->getRequestParameter('can_duracion'));
				$cancion->setUrl($this->getRequestParameter('can_url'));
				$cancion->setHabilitada($this->getRequestParameter('can_habilitada'));
				$cancion->setPrecio($this->getRequestParameter('can_precio'));
				$cancion->setRanking($this->getRequestParameter('can_ranking'));

				$cancion->save();
			}
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
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

		try{

			$conexion = new Criteria();
			$cancion = CancionsPeer::doSelect($conexion);

			foreach($cancion as $temporal)
			{
				$datos[$fila]['can_nombre'] = $temporal->setNombre();
				$datos[$fila]['can_autor'] = $temporal->setAutor();
				$datos[$fila]['can_album'] = $temporal->setAlbum();
				$datos[$fila]['can_fecha_de_publicacion'] = $temporal->setFechaDePublicacion();
				$datos[$fila]['can_duracion'] = $temporal->setDuracion();
				$datos[$fila]['can_url'] = $temporal->setUrl();
				$datos[$fila]['can_precio'] = $temporal->setPrecio();
				$datos[$fila]['can_habilitada'] = $temporal->setHabilitada();
				$datos[$fila]['can_ranking'] = $temporal->setRanking();

				$fila++;
			}
			if($fila>0){
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

		try{

			$can_codigo = $this->getUser()->getAttribute('can_codigo');
				
			$cancion;
			$cancion  = CancionsPeer::retrieveByPk($can_codigo);
	
			if($cancion){
				$cancion->delete();
				$salida = "({success: true, mensaje:'La Canci&oacute;n fue eliminada exitosamente'})";
			}
			
			if(!$cancion){
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
