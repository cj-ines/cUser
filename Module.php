<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cuser for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cuser;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adpter\Adapter;

use Doctrine\ORM\EntityManager;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
        	'factories' => array(
        		// Services
        		'AuthService' => function($sm) {
        			$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        			$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,'user','username','password','AND active=1');
        			$authService = new AuthenticationService();
        			$authService->setAdapter($dbTableAuthAdapter);
        			return $authService;
        			},
        		// Enitities
        		'Cuser\Entity\User' => function($sm) {
        	    	$entity = new \Cuser\Entity\User();
        	       	return $entity;
        	       },
            	'Cuser\Entity\Role' => function($sm) {
                	$entity = new \Cuser\Entity\Role();
                   	return $entity;
                   },
                // Forms
            	'Cuser\Form\UserForm' => function($sm) {
            		$form = new \Cuser\Form\UserForm($sm->get('Doctrine\ORM\EntityManager'));
            		$form->setInputFilter(new \Cuser\Form\UserFilter());
            		return $form;
               	},
               	'Cuser\Form\LoginForm' => function($sm) {
               		$form = new \Cuser\Form\LoginForm();
               		$form->setInputFilter(new \Cuser\Form\LoginFilter());
               		return $form;
               	},  
               ),
        );
    }
    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
