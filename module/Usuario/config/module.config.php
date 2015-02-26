<?php

namespace Usuario;

return array(
    'router' => array(
        'routes' => array(
            /*
            'usuario-create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => 'usuario/create',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller' => 'Index',
                        'action' => 'create'
                    )
                )
            ),*/

            'usuario-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),            
            
            'usuario-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),              
            
            'usuario-activate' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'Usuario\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            
            'usuario' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/usuario[/][/:action][/:key][page/:page]',
                    'defaults' => array(
                        'controller' => 'Usuario\Controller\Index',
                        'action' => 'index',
                        'key' => null,
                        'page' => 1
                    ),
                ),
            ),
            
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Usuario\Controller\Index' => 'Usuario\Controller\IndexController',
            'Usuario\Controller\Usuario' => 'Usuario\Controller\UsuarioController',
            'Usuario\Controller\Auth' => 'Usuario\Controller\AuthController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '../../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '../../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
        'fixture' => array(
            'Usuario_fixture' => __DIR__ . '/../src/Usuario/Fixture'
        )
    ),
);
