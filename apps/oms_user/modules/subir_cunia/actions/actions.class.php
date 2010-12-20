<?php

include_once('getid3/getid3.php');
include_once(GETID3_INCLUDEPATH.'getid3.functions.php'); // Function library

/**
 * subir_cunia actions.
 *
 * @package    oms
 * @subpackage subir_cunia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class subir_cuniaActions extends sfActions
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
  
  public function executeCrearCunia(sfWebRequest $request)
  {
	$salida	='';
	//$codigo_usuario = 2;
	$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
	
	try
	{  
		$nombre_carpeta = "uploads/cunias";
	
		if(!is_dir($nombre_carpeta))
		{
			mkdir($nombre_carpeta, 0777, true);
		}
		
		sleep(2);
	
		$nombre = $_FILES['cunia_archivo']['name'];
		$tamano = $_FILES['cunia_archivo']['size'];
		$tipo = $_FILES['cunia_archivo']['type'];
		$temporal = $_FILES['cunia_archivo']['tmp_name'];
		
		$format = '%Y-%m-%d %H:%M:%S';
		$fecha_creacion = strftime($format);
	
		if(file_exists($nombre_carpeta."/".$nombre))
		{
			$salida = "({success: false, errors: { reason: 'Ya existe el archivo con el mismo nombre en la base de datos'}})";
		}
		else
		{
			$copio=copy($temporal, "uploads/cunias/".$nombre);
			
			if($copio)
			{
				$atributos_cunia = GetAllMP3info($temporal);

				$cunia = new CuniaComercial();
				$cunia->setNombre($atributos_cunia['id3']['id3v1']['title']);
				$cunia->setFechaCreacion($fecha_creacion);
				$cunia->setDuracion($atributos_cunia['playtime_string']);
				$duracion_min_seg = explode(":", $atributos_cunia['playtime_string']);
				if($duracion_min_seg)
				{
					$precio = ( ( $duracion_min_seg[0] * 60 ) + $duracion_min_seg[1] ) * 500;
					$cunia->setPrecio($precio);
				}
				//echo($atributos_cunia['playtime_string']);
				$cunia->setUrl("uploads/cunias/".$nombre);
				$cunia->setHabilitada($this->getRequestParameter('cunia_habilitada'));
				$cunia->setUsuario($codigo_usuario);
				$cunia->save();	
				
				$salida = "({success: true, mensaje:'La cunia comercial fue creada exitosamente'})";
				return $this->renderText($salida);
			}
			else
			{
				$salida = "({success: false, errors: { reason: 'Hubo un problema al crear la cunia '}})";
			}
		}
	}
	catch (Exception $exception)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al crear la cunia ' , error: '".$exception->getMessage()."'}})";
		return $this->renderText($salida);
	}
	 		
	return $this->renderText($salida);
  }
  
	/**
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion actualiza una Cancions
	 */
	public function executeActualizarCunia(sfWebRequest $request)
	{
		$salida = '';

		try
		{
			$cunia_codigo = $this->getRequestParameter('codigo_cunia');

			$cunia  = CuniaComercialPeer::retrieveByPk($cunia_codigo);
				
			if($cunia)
			{
				$cunia->setNombre($this->getRequestParameter('cunia_nombre'));
				$cunia->setFechaCreacion($this->getRequestParameter('cunia_fecha_creacion'));
				$cunia->setDuracion($this->getRequestParameter('cunia_duracion'));
				//$cunia->setUrl($this->getRequestParameter('can_url'));
				$cunia->setHabilitada($this->getRequestParameter('cunia_habilitada'));

				$cunia->save();
			}
			else
			{
				$salida= "({success: false, errors: { reason: 'No existe la cunia '}})";
			}
			
			$salida = "({success: true, mensaje:'La cunia fue actualizada exitosamente'})";
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar cunia ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}

		return $this->renderText($salida);
	}
  
  /**
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion devuelve un listado de cunias
	 */
	public function executeListarCunias(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		//$codigo_usuario = 2;
		$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
		
		try
		{
			$conexion = new Criteria();
			$conexion->add(CuniaComercialPeer::USUARIO, $codigo_usuario);
			
			if($buscar != '')
			{
				$c1 = $conexion->getNewCriterion(CuniaComercialPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
				$conexion->add($c1);
			}
			
			$numero_cunias = CuniaComercialPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$cunias = CuniaComercialPeer::doSelect($conexion);

			foreach($cunias as $temporal)
			{
				$datos[$fila]['cunia_codigo'] = $temporal->getCodigo();
				$datos[$fila]['cunia_nombre'] = $temporal->getNombre();
				$datos[$fila]['cunia_fecha_creacion'] = $temporal->getFechaCreacion();
				$datos[$fila]['cunia_duracion'] = $temporal->getDuracion();
				$datos[$fila]['cunia_url'] = $temporal->getUrl();
				$datos[$fila]['cunia_habilitada'] = $temporal->getHabilitada();

				$fila++;
			}
			if($fila>0)
			{
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$numero_cunias.'","results":'.$jsonresult.'})';
			}

		}
		catch (Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar cunias ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
}
