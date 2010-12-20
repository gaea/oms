<?php

/**
 * programar_cunia actions.
 *
 * @package    oms
 * @subpackage programar_cunia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class programar_cuniaActions extends sfActions
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
	
	public function executeProgramarCunia(sfWebRequest $request)
	{
		$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
		
		$programacion_cunia_fecha = $this->getRequestParameter('programacion_cunia_fecha');
		$programacion_cunia_hora = $this->getRequestParameter('programacion_cunia_hora');
		$programacion_cunia_minuto = $this->getRequestParameter('programacion_cunia_minuto');
		$programacion_cunia_segundo = $this->getRequestParameter('programacion_cunia_segundo');
		$codigo_cunia_adquirida = $this->getRequestParameter('codigo_cunia_adquirida');
		
		$inicio = $programacion_cunia_hora.":".$programacion_cunia_minuto.":".$programacion_cunia_segundo;
		
		try
		{
			$cunia = CuniaComercialPeer::retrieveByPk($codigo_cunia_adquirida);
			
			if($cunia)
			{
				$venta = new Venta();
				$venta->setUsuario($codigo_usuario);
				$venta->setPrecio($cunia->getPrecio());
				
				$timeZone = new DateTimeZone('America/Bogota');
				$hoy = new DateTime("NOW", $timeZone);
				$venta->setFechaVenta($hoy);
				
				$venta_cunia = new VentaCuniaComercial();
				$venta_cunia->setCuniaComercialRelatedByCuniaComercial($cunia);
				$venta_cunia->setVentaRelatedByVenta($venta);
				$venta_cunia->save();
				
				$programacioncunia = new ProgramacionCuna();
				$programacioncunia->setCuniaComercial($cunia->getCodigo());
				$programacioncunia->setVenta($venta->getCodigo());
				$programacioncunia->setFecha($programacion_cunia_fecha);
				$programacioncunia->setInicio($inicio);
				$programacioncunia->setFin($inicio);
				$programacioncunia->save();
			}
			else
			{
				return $this->renderText("({success: false, errors: { reason: 'La cunia no ha sido comprada'}})");
			}
		}
		catch(Exception $exception)
		{
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n al realizar la programaci&oacute;n' , error: '".$exception->getMessage()."'}})");
		}
		
		$salida = "({success: true, mensaje:'Programaci&oacute;n hecha satisfactoriamente'})";
		return $this->renderText($salida);
	}
	
	public function executeListarProgramacionCunia(sfWebRequest $request)
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
			
			$conexion->addJoin(ProgramacionCunaPeer::CUNIA_COMERCIAL, CuniaComercialPeer::CODIGO);
			$conexion->addJoin(ProgramacionCunaPeer::VENTA, VentaPeer::CODIGO);
			//$conexion->addJoin(VentaPeer::CODIGO, VentacuniaPeer::VENTA);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario);
			//$conexion->addJoin(VentacuniaPeer::cunia, cuniaPeer::CODIGO);
			
			$numero_cunias = ProgramacionCunaPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$programacion = ProgramacionCunaPeer::doSelect($conexion);
			
			if($programacion)
			{
				foreach($programacion as $temporal)
				{
					$cunia = CuniaComercialPeer::retrieveByPk($temporal->getCuniaComercial());
				
					$datos[$fila]['programacion_cunia_codigo'] = $temporal->getCuniaComercial();
					$datos[$fila]['programacion_cunia_nombre'] = $cunia->getNombre();
					$datos[$fila]['programacion_cunia_fecha'] = $temporal->getFecha();
					$datos[$fila]['programacion_cunia_duracion'] = $cunia->getDuracion();
					$datos[$fila]['programacion_cunia_url'] = $cunia->getUrl();
					$datos[$fila]['programacion_cunia_inicio'] = $temporal->getInicio();

					$fila++;
				}
				if($fila>0)
				{
					$jsonresult = json_encode($datos);
					$salida= '({"total":"'.$numero_cunias.'","results":'.$jsonresult.'})';
				}
			}

		}
		catch (Exception $exception)
		{
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar cunias ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
  
	public function executeListarCuniaAdquirida(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		//$codigo_usuario = 2;
		$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');

		try
		{
			//$usuario = UsuarioPeer::retrieveByPk($codigo_usuario);
			$conexion = new Criteria();
			$conexion->add(CuniaComercialPeer::USUARIO, $codigo_usuario);
						
			if($buscar != '')
			{
				$c = $conexion->getNewCriterion(CuniaComercialPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
				$conexion->add($c);
			}
			
			$numero_cunias = CuniaComercialPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$cunia = CuniaComercialPeer::doSelect($conexion);

			foreach($cunia as $temporal)
			{
				$datos[$fila]['cunia_adquirida_codigo'] = $temporal->getCodigo();
				$datos[$fila]['cunia_adquirida_nombre'] = $temporal->getNombre();
				$datos[$fila]['cunia_adquirida_fecha_de_creacion'] = $temporal->getFechaCreacion();
				$datos[$fila]['cunia_adquirida_duracion'] = $temporal->getDuracion();
				$datos[$fila]['cunia_adquirida_url'] = $temporal->getUrl();
				$datos[$fila]['cunia_adquirida_precio'] = $temporal->getPrecio();
				$datos[$fila]['cunia_adquirida_habilitada'] = $temporal->getHabilitada();
				
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
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar cunias ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
}
