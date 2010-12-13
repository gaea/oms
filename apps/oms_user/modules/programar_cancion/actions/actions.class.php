<?php

/**
 * programar_cancion actions.
 *
 * @package    oms
 * @subpackage programar_cancion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class programar_cancionActions extends sfActions
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
	
	public function executeListarProgramacioncancion(sfWebRequest $request)
	{
		
	}
  
	public function executeListarCancionadquirida(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		$codigo_usuario = 2;

		try
		{
			$conexion = new Criteria();
			
			$conexion->addJoin(VentaPeer::CODIGO, VentaCancionPeer::VENTA);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			$conexion->addJoin(VentaCancionPeer::CANCION, CancionPeer::CODIGO);
			
			if($buscar != '')
			{
				$c1 = $conexion->getNewCriterion(CancionPeer::ALBUM, '%'.$buscar.'%', Criteria::LIKE);
				$c2 = $conexion->getNewCriterion(CancionPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
				$c3 = $conexion->getNewCriterion(CancionPeer::AUTOR, '%'.$buscar.'%', Criteria::LIKE);
				
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
				$datos[$fila]['cancion_adquirida_codigo'] = $temporal->getCodigo();
				$datos[$fila]['cancion_adquirida_nombre'] = $temporal->getNombre();
				$datos[$fila]['cancion_adquirida_autor'] = $temporal->getAutor();
				$datos[$fila]['cancion_adquirida_album'] = $temporal->getAlbum();
				$datos[$fila]['cancion_adquirida_fecha_de_publicacion'] = $temporal->getFechaDePublicacion();
				$datos[$fila]['cancion_adquirida_duracion'] = $temporal->getDuracion();
				$datos[$fila]['cancion_adquirida_url'] = $temporal->getUrl();
				$datos[$fila]['cancion_adquirida_precio'] = $temporal->getPrecio();
				$datos[$fila]['cancion_adquirida_habilitada'] = $temporal->getHabilitada();
				$datos[$fila]['cancion_adquirida_ranking'] = $temporal->getRanking();

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
}
