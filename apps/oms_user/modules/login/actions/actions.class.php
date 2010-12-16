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
	$salida= "({success: false, errors: { reason: 'El login no existe como cliente'}})";
	
	try
	{	
		$usuario = UsuarioPeer::doSelectOneCliente($login_usuario);
		
		if($usuario)
		{
			if( $usuario->getHabilitado() ){
				if( $usuario->validarContrasena($password_usuario) )
				{
					$this->getUser()->setAuthenticated(true);
					$this->getUser()->addCredential('cliente');
					$this->getUser()->setAttribute('codigo_usuario', $usuario->getCodigo());
					$salida = "({success: true, mensaje:'Ingreso valido en el sistema'})";
				}
				else
				{
					$salida= "({success: false, errors: { reason: 'Password incorrecto'}})";
				}
			}
			else
			{
				$salida= "({success: false, errors: { reason: 'Usuario deshabilitado'}})";
			}
		}
		else
		{
			$salida= "({success: false, errors: { reason: 'El login no existe como cliente'}})";
		}
	}
	catch (Exception $exception)
	{
		$salida= "({success: false, errors: { reason: 'Login o contraseña incorrecta' , error: '".$exception->getMessage()."'}})";
		return $this->renderText($salida);
	}
  
	return $this->renderText($salida);
  }
  
	public function executeDesautenticar()
	{
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->clearCredentials();
		$this->getUser()->getAttributeHolder()->clear();
		return  $this->renderText("({success: true, mensaje:'finaliza sesion'})");
	}

}

