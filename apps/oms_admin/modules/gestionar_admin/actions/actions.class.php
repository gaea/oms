<?php

/**
 * gestionar_admin actions.
 *
 * @package    oms
 * @subpackage gestionar_admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestionar_adminActions extends sfActions
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
  
  public function executeListar()
  {
	  $salida='({"total":"0", "results":""})';
	  $datos;
	  $fila = 0;
	  
	  try
	  {  
		  $admins = UsuarioPeer::doSelectAdministradores();
		  
		  foreach($admins As $admin)
		  {
			  if( $admin->getHabilitado() )
			  {
				  $persona = $admin->getPersonaRelatedByPersona();
				  $datos[$fila]['persona_codigo'] = $persona->getCodigo();
				  $datos[$fila]['persona_nombre'] = $persona->getNombre();
				  $datos[$fila]['persona_apellido'] = $persona->getApellido();
				  
				  $identificacion = TipoIdentificacionPeer::retrieveByPK($persona->getTipoIdentificacion());
				  $datos[$fila]['identificacion_codigo'] = $identificacion->getCodigo();
				  $datos[$fila]['identificacion_nombre'] = $identificacion->getNombre();
				  
				  $datos[$fila]['persona_identificacion'] = $persona->getIdentificacion();
				  $datos[$fila]['persona_direccion'] = $persona->getDireccion();
				  $datos[$fila]['persona_telefono'] = $persona->getTelefono();
				  $datos[$fila]['persona_email'] = $persona->getEMail();
				  
				  $datos[$fila]['usuario_codigo'] = $admin->getCodigo();
				  $datos[$fila]['usuario_nombre'] = $admin->getUsuario();
				  $datos[$fila]['usuario_contrasena'] = $admin->getContrasena();
				  
				  $fila++;
			  }
		  }
		  
		  if($fila>0)
		  {
			  $jsonresult = json_encode($datos);
			  $salida = '({"total":"'.$fila.'","results":'.$jsonresult.'})';
		  }
	  }
	  catch (Exception $exception)
	  {
		  $this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar administradores ' , error: '".$exception->getMessage()."'}})");
	  }
	  
	  return $this->renderText($salida);
  }
  
  public function executeCrear()
  {
	  $login_admin = $this->getRequestParameter('login_admin');
	  $admin = UsuarioPeer::doSelectOneAdministrador($login_admin);
	  
	  if($admin)
	  {
		$salida = "({success: false, errors: { reason: 'login ingresado ya existe'}})";
	  }
	  else
	  {
		  $persona = new Persona();
		  $persona->setNombre($this->getRequestParameter('nombre_persona'));
		  $persona->setApellido($this->getRequestParameter('apellido_persona'));
		  $persona->setTipoIdentificacion($this->getRequestParameter('id_tipo_identificacion'));
		  $persona->setIdentificacion($this->getRequestParameter('identificacion_persona'));
		  $persona->setDireccion($this->getRequestParameter('direccion_persona'));
		  $persona->setTelefono($this->getRequestParameter('telefono_persona'));
		  $persona->setEMail($this->getRequestParameter('email_persona'));
		  
		  $usuario = new Usuario();
		  $usuario->setUsuario($login_admin);
		  $usuario->setContrasena($this->getRequestParameter('contrasena_admin'));
		  $usuario->setPerfil(UsuarioPeer::getCodigoPerfilAdmin());
		  $usuario->setHabilitado(true);
		  $usuario->setPersonaRelatedByPersona($persona);
			
		  try
		  {
			$usuario->save();
			$salida = "({success: true, mensaje:'Administrador creado con exito'})";
	      }
		  catch (Exception $exception)
		  {
			$salida= "({success: false, errors: { reason: 'Excepcion, Hubo un problema al crear el administrador' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		  }
	  }
	  
	  return  $this->renderText($salida);
	}

	public function executeActualizar()
	{
		$login_admin = $this->getRequestParameter('login_admin');
		$usuario = UsuarioPeer::doSelectOneAdministrador($login_admin);
			
		if($usuario)
		{
			$persona = new Persona();
			$persona->setNombre($this->getRequestParameter('nombre_persona'));
			$persona->setApellido($this->getRequestParameter('apellido_persona'));
			$persona->setTipoIdentificacion($this->getRequestParameter('id_tipo_identificacion'));
			$persona->setIdentificacion($this->getRequestParameter('identificacion_persona'));
			$persona->setDireccion($this->getRequestParameter('direccion_persona'));
			$persona->setTelefono($this->getRequestParameter('telefono_persona'));
			$persona->setEMail($this->getRequestParameter('email_persona'));
				
			$usuario->setContrasena($this->getRequestParameter('contrasena_admin'));
			$usuario->setPersonaRelatedByPersona($persona);

			try
			{
				$usuario->save();
				$salida = "({success: true, mensaje:'Actualizacion de administrador con exito'})";
			}
			catch (Exception $exception)
			{
				$salida= "({success: false, errors: { reason: 'Excepcion, Hubo un problema al intentar actualizar el administrador' , error: '".$exception->getMessage()."'}})";
				return $this->renderText($salida);
			}

		} 
		else
		{
			$salida = "({success: false, errors: { reason: 'Administrador a actualizar no encontrado'}})";
		}
		
		return $this->renderText($salida);
	}
	
	
	public function executeDeshabilitar()
	{	
		$login_admin = $this->getRequestParameter('login_admin');
		$admin = UsuarioPeer::doSelectOneAdministrador($login_admin);
		
		if($admin)
		{
			$admin->setHabilitado(false);
			
			try
			{
				$admin->save();
				$salida = "({success: true, mensaje:'Administrador dado de baja con exito'})";
			} 
			catch (Exception $exception)
			{
				return $this->renderText("({success: false, errors: { reason: 'Excepcion, Hubo un problema al dar de baja el administrador' , error: '".$exception->getMessage()."'}})");
			}
		}
		else
		{
			$salida = "({success: false, errors: { reason: 'Administrador a actualizar no encontrado'}})";
		}
		
		return $this->renderText($salida);
	}
}
