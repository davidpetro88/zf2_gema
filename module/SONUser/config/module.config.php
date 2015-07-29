<?php

namespace SONUser;

return array(
    'router' => array(
        'routes' => array(
            'sonuser-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register',
                    )
                )
            ),
            'sonuser-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'SONUser\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            'sonuser-auth' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'sonuser-logout' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),

            'sonuser-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin-user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Users',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'Users'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'Users',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonuser-sessao' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/sessao',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'sessoes',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'sessoes'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'sessoes',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonuser-materia' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/materia',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'materias',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'materias'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'materias',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonuser-public-list-materia' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/noticias',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'noticias',
                        'action' => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'noticias'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'noticias',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonuser-status-materia' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/status-materia',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'status',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'status'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'status',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonuser-capa-materia' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/capa-materia',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'capa',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'capa'
                            )
                        )
                    ),
                    'pagination' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => '[/:controller]/page[/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults'    => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'capa',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            )

        )
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'SONUser\Controller\Index' => 'SONUser\Controller\IndexController',
            'SONUser\Controller\Users' => 'SONUser\Controller\UsersController',
            'SONUser\Controller\Sessoes' => 'SONUser\Controller\SessoesController',
            'SONUser\Controller\Materias' => 'SONUser\Controller\MateriasController',
            'SONUser\Controller\Noticias' => 'SONUser\Controller\NoticiasController',
            'SONUser\Controller\Status' => 'SONUser\Controller\StatusController',
            'SONUser\Controller\Auth' => 'SONUser\Controller\AuthController',
            'SONUser\Controller\Capa' => 'SONUser\Controller\CapaController',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
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
                ),
            ),
        ),
        'fixture' => array(
            __NAMESPACE__ => __DIR__ . '/../src/'.__NAMESPACE__.'/Fixture',
        ),
    ),
);