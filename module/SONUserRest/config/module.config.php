<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SONUserRest\Controller\UserRest' => 'SONUserRest\Controller\UserRestController',
            'SONUserRest\Controller\ComentarioRest' => 'SONUserRest\Controller\ComentarioRestController',
            'SONUserRest\Controller\SessaoRest' => 'SONUserRest\Controller\SessaoRestController',
            'SONUserRest\Controller\StatusRest' => 'SONUserRest\Controller\StatusRestController',
            'SONUserRest\Controller\CapaRest' => 'SONUserRest\Controller\CapaRestController',
            'SONUserRest\Controller\MateriaRest' => 'SONUserRest\Controller\MateriaRestController',
            'SONUserRest\Controller\RoleRest' => 'SONUserRest\Controller\RoleRestController'
        )
    ),
    'router' => array(
        'routes' => array(
            'sonuser-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/user[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\UserRest'
                    )
                )
            ),
            'sonuser-comentario-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/comentario[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\ComentarioRest'
                    )
                )
            ),
            'sonuser-sessao-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/sessao[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\SessaoRest'
                    )
                )
            ),
            'sonuser-status-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/status[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\StatusRest'
                    )
                )
            ),
            'sonuser-capa-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/capa[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\CapaRest'
                    )
                )
            ),
            'sonuser-materia-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/materia[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\MateriaRest'
                    )
                )
            ),
            'sonuser-role-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/role[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'SONUserRest\Controller\RoleRest'
                    )
                )
            ),

        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
//     'doctrine' => array(
//         'driver' => array(
//             __NAMESPACE__ . '_driver' => array(
//                 'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//                 'cache' => 'array',
//                 'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
//             ),
//             'orm_default' => array(
//                 'drivers' => array(
//                     'SONUser' . '\Entity' => 'SONUser' . '_driver'
//                 ),
//             ),
//         ),
//     ),
);