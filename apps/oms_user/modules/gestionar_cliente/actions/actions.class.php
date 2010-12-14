<?php

/**
 * gestionar_cliente actions.
 *
 * @package    oms
 * @subpackage gestionar_cliente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestionar_clienteActions extends sfActions
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
  
  public function executeRegistrar()
  {
	  $login_cliente = $this->getRequestParameter('login_cliente');
	  $cliente = UsuarioPeer::doSelectOneUsuario($login_cliente);
	  
	  if($cliente)
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
		  $usuario->setUsuario($login_cliente);
		  $usuario->setContrasena($this->getRequestParameter('contrasena_cliente'));
		  $usuario->setPerfil(UsuarioPeer::getCodigoPerfilCliente());
		  $usuario->setHabilitado(true);
		  $usuario->setPersonaRelatedByPersona($persona);
			
		  try
		  {
			$usuario->save();
			$salida = "({success: true, mensaje:'cliente registrado con exito'})";
	      }
		  catch (Exception $exception)
		  {
			$salida= "({success: false, errors: { reason: 'Excepcion, Hubo un problema al registrar el cliente' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		  }
	  }
	  
	  return  $this->renderText($salida);
	}

	public function executeActualizar()
	{
		$login_cliente = $this->getRequestParameter('login_cliente');
		$usuario = UsuarioPeer::doSelectOneCliente($login_cliente);
			
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
				
			$usuario->setContrasena($this->getRequestParameter('contrasena_cliente'));
			$usuario->setPersonaRelatedByPersona($persona);

			try
			{
				$usuario->save();
				$salida = "({success: true, mensaje:'Actualizacion de cliente con exito'})";
			}
			catch (Exception $exception)
			{
				$salida= "({success: false, errors: { reason: 'Excepcion, Hubo un problema al intentar actualizar el cliente' , error: '".$exception->getMessage()."'}})";
				return $this->renderText($salida);
			}

		} 
		else
		{
			$salida = "({success: false, errors: { reason: 'cliente a actualizar no encontrado'}})";
		}
		
		return $this->renderText($salida);
	}
	
	
	public function executeDeshabilitar()
	{	
		$login_cliente = $this->getRequestParameter('login_cliente');
		$cliente = UsuarioPeer::doSelectOneCliente($login_cliente);
		
		if($cliente)
		{
			$cliente->setHabilitado(false);
			$salida = "({success: true, mensaje:'clienteistrador dado de baja con exito'})";
		}
		else
		{
			$salida = "({success: false, errors: { reason: 'cliente a actualizar no encontrado'}})";
		}
		
		return $this->renderText($salida);
	}
}
