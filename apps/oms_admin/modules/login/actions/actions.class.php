<?php

/**
 * login actions.
 *
 * @package    oms
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
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
  
  public function executeAutenticar(sfWebRequest $request)
  {
    $this->getUser()->setAuthenticated(false);
	$this->getUser()->clearCredentials();
	$this->getUser()->getAttributeHolder()->clear();
	
	$login_usuario = $this->getRequestParameter('login_usuario');
	$password_usuario = $this->getRequestParameter('password_usuario');
	$salida= "({success: false, errors: { reason: 'El login no existe como administrador'}})";
	
	try
	{
		$conexion = new Criteria();

		$conexion->add(UsuarioPeer::USUARIO, $login_usuario);
		$conexion->add(UsuarioPeer::PERFIL, 1); // perfil admin
		
		$usuario = UsuarioPeer::doSelectOne($conexion);
		//echo 'qwwer';
		if($usuario)
		{
			if($usuario->getContrasena() == $password_usuario)
			{
				if($usuario->getPerfil() == 1)
				{
					$this->getUser()->setAuthenticated(true);
					$this->getUser()->addCredential('admin');
					$this->getUser()->setAttribute('codigo_usuario', $usuario->getCodigo());
					$salida = "({success: true, mensaje:'Ingreso valido en el sistema'})";
				}
				else
				{
					$salida= "({success: false, errors: { reason: 'El usuario no es administrador'}})";
				}
			}
			else
			{
				$salida= "({success: false, errors: { reason: 'Password incorrecto'}})";
			}
		}
		else
		{
			$salida= "({success: false, errors: { reason: 'El login no existe como administrador'}})";
		}
	}
	catch (Exception $exception)
	{
		$salida= "({success: false, errors: { reason: 'Login o contraseņa incorrecta' , error: '".$exception->getMessage()."'}})";
		return $this->renderText($salida);
	}
  
	return $this->renderText($salida);
  }
  
	public function executeDesautenticar()
	{
		//session_destroy();
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->clearCredentials();
		$this->getUser()->getAttributeHolder()->clear();
		return  $this->renderText("({success: true, mensaje:'finaliza sesion'})");
	}
	
	public function executeConsultarAdmin(){
		$codigo_usuario = $this->getUser()->getAttribute('codigo_usuario');
		$salida='({"total":"0", "results":""})';
		
		if($codigo_usuario){
			$usuario = UsuarioPeer::retrieveByPK($codigo_usuario);
						
			if( $usuario->esAdministrador() )
			{
				$persona = $usuario->getPersonaRelatedByPersona();
				$datos[0]['persona_codigo'] = $persona->getCodigo();
				$datos[0]['persona_nombre'] = $persona->getNombre();
				$datos[0]['persona_apellido'] = $persona->getApellido();
				
				$identificacion = TipoIdentificacionPeer::retrieveByPK($persona->getTipoIdentificacion());
				$datos[0]['identificacion_codigo'] = $identificacion->getCodigo();
				$datos[0]['identificacion_nombre'] = $identificacion->getNombre();
				
				$datos[0]['persona_identificacion'] = $persona->getIdentificacion();
				$datos[0]['persona_direccion'] = $persona->getDireccion();
				$datos[0]['persona_telefono'] = $persona->getTelefono();
				$datos[0]['persona_email'] = $persona->getEMail();
				
				$datos[0]['usuario_codigo'] = $usuario->getCodigo();
				$datos[0]['usuario_nombre'] = $usuario->getUsuario();
				$datos[0]['usuario_contrasena'] = $usuario->getContrasena();
				
				$jsonresult = json_encode($datos);
				$salida = '({"total": "1","results":'.$jsonresult.'})';
			}
		}
		
		return  $this->renderText($salida);
	}
}
