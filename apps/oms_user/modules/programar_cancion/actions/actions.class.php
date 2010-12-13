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
	
	public function executeProgramarCancion(sfWebRequest $request)
	{
		$codigo_usuario = 2;
		
		$programacion_cancion_fecha = $this->getRequestParameter('programacion_cancion_fecha');
		$programacion_cancion_hora = $this->getRequestParameter('programacion_cancion_hora');
		$programacion_cancion_minuto = $this->getRequestParameter('programacion_cancion_minuto');
		$programacion_cancion_segundo = $this->getRequestParameter('programacion_cancion_segundo');
		$codigo_cancion_adquirida = $this->getRequestParameter('codigo_cancion_adquirida');
		
		$inicio = $programacion_cancion_hora.":".$programacion_cancion_minuto.":".$programacion_cancion_segundo;
		
		try
		{
			$conexion = new Criteria();
			
			//$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			$conexion->addJoin(VentaCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			$conexion->add(VentaCancionPeer::CANCION, $codigo_cancion_adquirida);
			//$conexion->addJoin(VentaCancionPeer::CANCION, CancionPeer::CODIGO);
			
			$venta = VentaPeer::doSelectOne($conexion);
			
			if($venta)
			{
				$programacioncancion = new ProgramacionCancion();
				$programacioncancion->setCancion($codigo_cancion_adquirida);
				$programacioncancion->setVenta($venta->getCodigo());
				$programacioncancion->setFecha($programacion_cancion_fecha);
				$programacioncancion->setInicio($inicio);
				$programacioncancion->save();
			}
			else
			{
				return $this->renderText("({success: false, errors: { reason: 'La canci&oacue;n no ha sido comprada'}})");
			}
		}
		catch(Exception $exception)
		{
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n al realizar la programaci&oacute;n' , error: '".$exception->getMessage()."'}})");
		}
		
		$salida = "({success: true, mensaje:'Programaci&oacute;n hecha satisfactoriamente'})";
		return $this->renderText($salida);
	}
	
	public function executeListarProgramacioncancion(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		$codigo_usuario = 2;

		try
		{
			$conexion = new Criteria();
			
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			//$conexion->addJoin(VentaPeer::CODIGO, VentaCancionPeer::VENTA);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			//$conexion->addJoin(VentaCancionPeer::CANCION, CancionPeer::CODIGO);
			
			
			$numero_canciones = ProgramacionCancionPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$programacion = ProgramacionCancionPeer::doSelect($conexion);

			if($programacion)
			{
				foreach($programacion as $temporal)
				{
					$cancion = CancionPeer::retrieveByPk($temporal->getCancion());
				
					$datos[$fila]['programacion_cancion_codigo'] = $temporal->getCancion();
					$datos[$fila]['programacion_cancion_nombre'] = $cancion->getNombre();
					$datos[$fila]['programacion_cancion_fecha'] = $temporal->getFecha();
					$datos[$fila]['programacion_cancion_duracion'] = $cancion->getDuracion();
					$datos[$fila]['programacion_cancion_url'] = $cancion->getUrl();
					$datos[$fila]['programacion_cancion_inicio'] = $temporal->getInicio();

					$fila++;
				}
				if($fila>0)
				{
					$jsonresult = json_encode($datos);
					$salida= '({"total":"'.$numero_canciones.'","results":'.$jsonresult.'})';
				}
			}

		}
		catch (Exception $exception)
		{
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})");
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
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar canciones ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
}
