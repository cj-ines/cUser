<?php
namespace Cuser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends CbaseController
{
	public function loginAction()
	{
		if ($this->getIdentity()) {
			$this->redirect()->toRoute('cuser');
		}
		$form = $this->getServiceLocator()->get('Cuser\Form\LoginForm');
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$post = $request->getPost();
			$form->setData($post);
			if ($form->isValid()) {
				$auth = $this->getAuthService()->getAdapter();
				$auth->setIdentity($post->username)->setCredential($post->password);
				$result = $this->getAuthService()->authenticate();
				if ($result->isValid()){
					$this->getAuthService()->getStorage()->write($post->username);
				}
			}
		}
		
		$loginform = new ViewModel(array('form' => $form ));
		$loginform->setTemplate('cuser/widgets/login-form-lg');
		
		$view = new ViewModel();
		$view->addChild($loginform,'loginform');
		
		return $view;
	}
	
	public function indexAction()
	{
		
	}
	
	public function registerAction()
	{
		if ($this->getIdentity()) {
			$this->redirect()->toRoute('cuser');
		}
		
		$form = $this->getServiceLocator()->get('Cuser\Form\UserForm');
		$request = $this->getRequest();
		if ($request->isPost()){
			$post = $request->getPost();
			$form->setData($post);
			$post->role = 1;
			if ($form->isValid()) {
				$user = $this->getUserEntity();
				$post->role = $this->getRole(1);
				$em = $this->getEntityManager();
				$user->exchangeArray($post);
				$em->persist($user);
				$em->flush();
			}
			print_r($form->getMessages());
		} 
		
		$registerform = new ViewModel(array('form' => $form));
		$registerform->setTemplate('cuser/widgets/register-form');
		
		$view = new ViewModel();
		$view->addChild($registerform,'registerform');
		
		return $view;
	}
	
	public function logoutAction()
	{
		$this->getAuthService()->clearIdentity();
	
		return $this->redirect()->toRoute('cuser/login');
	}
}