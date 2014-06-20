<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cuser for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cuser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DateTime; 

class IndexController extends CbaseController
{
    public function indexAction()
    {
        return array();
    }
	
    public function registerAction() 
    {
    	
    	$error=false;
    	$form = $this->getServiceLocator()->get('Cuser\Form\UserForm');
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setData($request->getPost());
    		if (!$form->isValid()) {
    			$error = true;
    		}
    		$em = $this->getEntityManager();
    		$user = $this->getUserEntity();
    		$role = $this->getRole($request->getPost()->role);
    		$user->exchangeArray($form->getData());
    		$user->setRole($role);
    		$em->persist($user);
    		$em->flush($user);
    		
    	}
    	$view = new ViewModel(array(
    		'form' => $form,
    		'error' => $error,
    	));
    	return $view;
    }
    
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /index/index/foo
        return array();
    }
}
