<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cuser\Controller\Index' => 'Cuser\Controller\IndexController',
        	'Cuser\Controller\Login' => 'Cuser\Controller\LoginController',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Cuser/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Cuser\Entity' => 'application_entities'
                )
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'cuser' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/user',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Cuser\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                	'login' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'     => '/login[/][:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        	'defaults' => array(
                        		'controller' => 'Login',
                            	'action' => 'Index',
                            )
                        ),
                    ),
                	'user' => array(
                		'type'    => 'Segment',
                		'options' => array(
                			'route'     => '/user-admin[/][:action]',
                			'constraints' => array(
                				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                				),
                			'defaults' => array(
                				'controller' => 'Index',
                				'action' => 'index',
                			)
                		),
                	),
                	/* 'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),*/
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cuser' => __DIR__ . '/../view',
        		
        ),
    ),
);
