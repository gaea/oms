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

		try
		{
			$conexion = new Criteria();
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
	
	public function executeComprarCancion(sfWebRequest $request)
	{
		$codigo_usuario = 2;
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
