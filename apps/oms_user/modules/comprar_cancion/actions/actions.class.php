<?php

/**
 * comprar_cancion actions.
 *
 * @package    oms
 * @subpackage comprar_cancion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comprar_cancionActions extends sfActions
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
	 *@author:gaea
	 *@date:2 de dic de 2010
	 *Esta funcion devuelve un listado de canciones
	 */
	public function executeListarCanciondisponible(sfWebRequest $request)
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
				$salida= '({"total":"'.$numero_canciones.'","results":'.$jsonresult.'})';
			}

		}
		catch (Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
	
	public function executeListarCancionadquirida(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		$codigo_usuario = 2;
		//$codigo_usuario = $this->getUser()->setAttribute('codigo_usuario');

		try
		{
			$conexion = new Criteria();
			
			$conexion->addJoin(VentaPeer::CODIGO, VentaCancionPeer::VENTA);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			$conexion->addJoin(VentaCancionPeer::CANCION, CancionPeer::CODIGO);
			
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
				$salida= '({"total":"'.$numero_canciones.'","results":'.$jsonresult.'})';
			}

		}
		catch (Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
	
	public function executeComprarCancion(sfWebRequest $request)
	{
		$codigo_usuario = 2;
		//$codigo_usuario = $this->getUser()->setAttribute('codigo_usuario');
		$comprar_canciones = json_decode($this->getRequestParameter('canciones'));
		$precio = 0;
		$format = '%Y-%m-%d %H:%M:%S';
		$fecha_venta = strftime($format);
		//$fecha_venta = '1999-01-08 04:05:06';
		
		try
		{
			//$usuario = UsuarioPeer::retrieveByPk($codigo_usuario);
			$venta = new Venta();
			$venta->setUsuario($codigo_usuario);
			$venta->setPrecio($precio);
			$venta->setFechaVenta($fecha_venta);
			$venta->save();
			for($i = 0; $i < sizeof($comprar_canciones); $i++)
			{
				$cancion = CancionPeer::retrieveByPk($comprar_canciones[$i]);
				$precio += $cancion->getPrecio();
				$venta_cancion = new VentaCancion();
				$venta_cancion->setVenta($venta->getCodigo());
				$venta_cancion->setCancion($comprar_canciones[$i]);
				$venta_cancion->save();
			}
			$venta->setPrecio($precio);
			$venta->save();
		}
		catch(Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al realizar la compra' , error: '".$exception->getMessage()."'}})";
		}
		
		$salida = "({success: true, mensaje:'Compra hecha satisfactoriamente'})";
		return $this->renderText($salida);
	}
}
