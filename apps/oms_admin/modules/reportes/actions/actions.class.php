<?php

/**
 * reportes actions.
 *
 * @package    oms
 * @subpackage reportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportesActions extends sfActions
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
  
	public function executeListarClientes(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$buscar = $this->getRequestParameter('buscar');
		
		try
		{
			$conexion = new Criteria();
			$conexion->addJoin(UsuarioPeer::PERSONA, PersonaPeer::CODIGO);
			$conexion->add(UsuarioPeer::PERFIL, 2); /// perfil empresa
			
			if($buscar != '')
			{
				//$c7 = $conexion->getNewCriterion(UsuarioPeer::CODIGO, '%'.$buscar.'%', Criteria::LIKE);
				$c1 = $conexion->getNewCriterion(UsuarioPeer::USUARIO, '%'.$buscar.'%', Criteria::LIKE);
				//$c8 = $conexion->getNewCriterion(UsuarioPeer::HABILITADO, '%'.$buscar.'%', Criteria::LIKE);
				$c2 = $conexion->getNewCriterion(PersonaPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
				$c3 = $conexion->getNewCriterion(PersonaPeer::APELLIDO, '%'.$buscar.'%', Criteria::LIKE);
				$c4 = $conexion->getNewCriterion(PersonaPeer::IDENTIFICACION, '%'.$buscar.'%', Criteria::LIKE);
				$c5 = $conexion->getNewCriterion(PersonaPeer::DIRECCION, '%'.$buscar.'%', Criteria::LIKE);
				$c6 = $conexion->getNewCriterion(PersonaPeer::TELEFONO, '%'.$buscar.'%', Criteria::LIKE);
				$c7 = $conexion->getNewCriterion(PersonaPeer::E_MAIL, '%'.$buscar.'%', Criteria::LIKE);
				
				//$c8->addOr($c9);
				//$c7->addOr($c8);
				$c6->addOr($c7);
				$c5->addOr($c6);
				$c4->addOr($c5);
				$c3->addOr($c4);
				$c2->addOr($c3);
				$c1->addOr($c2);
				
				$conexion->add($c1);
			}
			
			$numero_usuarios = UsuarioPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$cliente = UsuarioPeer::doSelect($conexion);

			foreach($cliente as $temporal)
			{
				$datos[$fila]['codigo'] = $temporal->getCodigo();
				$datos[$fila]['usuario'] = $temporal->getUsuario();
				$datos[$fila]['nombre'] = $temporal->getPersonaRelatedByPersona()->getNombre();
				$datos[$fila]['apellido'] = $temporal->getPersonaRelatedByPersona()->getApellido();
				$datos[$fila]['identificacion'] = $temporal->getPersonaRelatedByPersona()->getIdentificacion();
				$datos[$fila]['tipo_identificacion'] = $temporal->getPersonaRelatedByPersona()->getTipoIdentificacionRelatedByTipoIdentificacion()->getNombre();
				$datos[$fila]['direccion'] = $temporal->getPersonaRelatedByPersona()->getDireccion();
				$datos[$fila]['telefono'] = $temporal->getPersonaRelatedByPersona()->getTelefono();
				$datos[$fila]['e_mail'] = $temporal->getPersonaRelatedByPersona()->getEMail();
				$datos[$fila]['habilitado'] = $temporal->getHabilitado();

				$fila++;
			}
			if($fila>0)
			{
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$numero_usuarios.'","results":'.$jsonresult.'})';
			}

		}
		catch (Exception $exception)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar clientes ' , error: '".$exception->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
	
	public function executeListarProgramacioncancion(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos;
		$codigo_usuario = $this->getRequestParameter('codigo_usuario');
		
		try
		{
			$conexion = new Criteria();
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $codigo_usuario); 
			
			$numero_canciones = ProgramacionCancionPeer::doCount($conexion);
			$conexion->setLimit($this->getRequestParameter('limit'));
			$conexion->setOffset($this->getRequestParameter('start'));
			$programacion = ProgramacionCancionPeer::doSelect($conexion);

			foreach($programacion as $temporal)
			{
				$datos[$fila]['can_codigo'] = $temporal->getCancionRelatedByCancion()->getCodigo();
				$datos[$fila]['can_nombre'] = $temporal->getCancionRelatedByCancion()->getNombre();
				$datos[$fila]['can_autor'] = $temporal->getCancionRelatedByCancion()->getAutor();
				$datos[$fila]['can_album'] = $temporal->getCancionRelatedByCancion()->getAlbum();
				$datos[$fila]['can_fecha_de_publicacion'] = $temporal->getCancionRelatedByCancion()->getFechaDePublicacion();
				$datos[$fila]['can_duracion'] = $temporal->getCancionRelatedByCancion()->getDuracion();
				$datos[$fila]['can_url'] = $temporal->getCancionRelatedByCancion()->getUrl();
				$datos[$fila]['can_habilitada'] = $temporal->getCancionRelatedByCancion()->getHabilitada();
				$datos[$fila]['can_precio'] = $temporal->getCancionRelatedByCancion()->getPrecio();
				$datos[$fila]['can_ranking'] = $temporal->getCancionRelatedByCancion()->getRanking();
				$datos[$fila]['can_fecha'] = $temporal->getFecha();
				$datos[$fila]['can_inicio'] = $temporal->getInicio();

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
			return $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n al listar la programaci&oacute;n ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
	
	public function executeImprimir()
	{
		$config = sfTCPDFPluginConfigHandler::loadConfig();
		$buscar = $this->getRequestParameter('buscar');

		$pdf = new sfTCPDF();


		$pdf->SetFont('FreeSerif', '', 8);
		//$pdf->SetTextColor(78,79,178);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', '13'));
		$pdf->SetHeaderData('oms_orig.jpg', 15, 'Open Music Suscriptor', 'Listado de clientes y su programacion');
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		//$this->SetTextColor(0);

		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$this->html='<h1 align="center">Listado de clientes y su programacion</h1>';
		
		$conexion = new Criteria();
		$conexion->addJoin(UsuarioPeer::PERSONA, PersonaPeer::CODIGO);
		$conexion->add(UsuarioPeer::PERFIL, 2); 
		
		if($buscar != '')
		{
			//$c7 = $conexion->getNewCriterion(UsuarioPeer::CODIGO, '%'.$buscar.'%', Criteria::LIKE);
			$c1 = $conexion->getNewCriterion(UsuarioPeer::USUARIO, '%'.$buscar.'%', Criteria::LIKE);
			//$c8 = $conexion->getNewCriterion(UsuarioPeer::HABILITADO, '%'.$buscar.'%', Criteria::LIKE);
			$c2 = $conexion->getNewCriterion(PersonaPeer::NOMBRE, '%'.$buscar.'%', Criteria::LIKE);
			$c3 = $conexion->getNewCriterion(PersonaPeer::APELLIDO, '%'.$buscar.'%', Criteria::LIKE);
			$c4 = $conexion->getNewCriterion(PersonaPeer::IDENTIFICACION, '%'.$buscar.'%', Criteria::LIKE);
			$c5 = $conexion->getNewCriterion(PersonaPeer::DIRECCION, '%'.$buscar.'%', Criteria::LIKE);
			$c6 = $conexion->getNewCriterion(PersonaPeer::TELEFONO, '%'.$buscar.'%', Criteria::LIKE);
			$c7 = $conexion->getNewCriterion(PersonaPeer::E_MAIL, '%'.$buscar.'%', Criteria::LIKE);
			
			//$c8->addOr($c9);
			//$c7->addOr($c8);
			$c6->addOr($c7);
			$c5->addOr($c6);
			$c4->addOr($c5);
			$c3->addOr($c4);
			$c2->addOr($c3);
			$c1->addOr($c2);
			
			$conexion->add($c1);
		}

		$cliente = UsuarioPeer::doSelect($conexion);

		foreach($cliente as $temporal)
		{
		
			$conexion = new Criteria();
			$conexion->addJoin(ProgramacionCancionPeer::VENTA, VentaPeer::CODIGO);
			$conexion->addJoin(ProgramacionCancionPeer::CANCION, CancionPeer::CODIGO);
			$conexion->add(VentaPeer::USUARIO, $temporal->getCodigo());
			$conexion->addAscendingOrderByColumn(ProgramacionCancionPeer::FECHA);
			$conexion->addAscendingOrderByColumn(ProgramacionCancionPeer::INICIO);
			$programacion = ProgramacionCancionPeer::doSelect($conexion);

			if($programacion)
			{
				$color='#ffffff';
				$this->html.='<table align="center" border=1 width="100%">';
				$this->html.='<tr>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#4E79B2"><font face=arial size=4 color="white">';
				$this->html.='<b>Usuario</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#4E79B2"><font face=arial size=4 color="white">';
				$this->html.='<b>Nombre</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#4E79B2"><font face=arial size=4 color="white">';
				$this->html.='<b>Apellido</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#4E79B2"><font face=arial size=4 color="white">';
				$this->html.='<b>Identificacion</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#4E79B2"><font face=arial size=4 color="white">';
				$this->html.='<b>e-mail</b>';
				$this->html.='</font></td>';
				$this->html.='</tr>';
				$this->html.='<tr>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#ffffff"><font face=arial size=4 color="white">';
				$this->html.='<b>'.$temporal->getUsuario().'</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#ffffff"><font face=arial size=4 color="white">';
				$this->html.='<b>'.$temporal->getPersonaRelatedByPersona()->getNombre().'</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#ffffff"><font face=arial size=4 color="white">';
				$this->html.='<b>'.$temporal->getPersonaRelatedByPersona()->getApellido().'</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#ffffff"><font face=arial size=4 color="white">';
				$this->html.='<b>'.$temporal->getPersonaRelatedByPersona()->getIdentificacion().'</b>';
				$this->html.='</font></td>';
				$this->html.='<td width="20%" colspan=2 align="center" bgcolor="#ffffff"><font face=arial size=4 color="white">';
				$this->html.='<b>'.$temporal->getPersonaRelatedByPersona()->getEMail().'</b>';
				$this->html.='</font></td>';
				$this->html.='</tr>';
				$this->html.='<tr bgcolor="gray">';
				$this->html.='<td width="20%"><b>Cancion</b></td>';
				$this->html.='<td width="20%"><b>Autor</b></td>';
				$this->html.='<td width="20%"><b>Album</b></td>';
				$this->html.='<td width="10%"><b>Duracion</b></td>';
				$this->html.='<td width="10%"><b>Precio</b></td>';
				$this->html.='<td width="10%"><b>Fecha</b></td>';
				$this->html.='<td width="10%"><b>Hora</b></td>';
				$this->html.='</tr>';
				foreach($programacion as $tmp)
				{
					$this->html.='<tr bgcolor="'.$color.'">';
					$this->html.='<td width="20%">';
					$this->html.=$tmp->getCancionRelatedByCancion()->getNombre();
					$this->html.='</td>';
					$this->html.='<td width="20%">';
					$this->html.=$tmp->getCancionRelatedByCancion()->getAutor();
					$this->html.='</td>';
					$this->html.='<td width="20%">';
					$this->html.=$tmp->getCancionRelatedByCancion()->getAlbum();
					$this->html.='</td>';
					$this->html.='<td width="10%">';
					$this->html.=$tmp->getCancionRelatedByCancion()->getDuracion();
					$this->html.='</td>';
					$this->html.='<td width="10%">';
					$this->html.='$'.$tmp->getCancionRelatedByCancion()->getPrecio();
					$this->html.='</td>';
					$this->html.='<td width="10%">';
					$this->html.=$tmp->getFecha();
					$this->html.='</td>';
					$this->html.='<td width="10%">';
					$this->html.=$tmp->getInicio();
					$this->html.='</td>';
					$this->html.='</tr>';
					if($color=='#ffffff')
					{
						$color='#dbe3ff';
					}
					else
					{
						$color='#ffffff';
					}
				}
				$this->html.='</table>';
				$pdf->writeHTML($this->html);
				$this->html='';
				$pdf->ln();
			}
		}
		// output
		$pdf->writeHTML($this->html);
		$pdf->ln();
		$pdf->Output();

		// Stop symfony process
		throw new sfStopException();
	}
}
