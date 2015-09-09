<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SONUserRest\Controller\UserRest' => 'SONUserRest\Controller\UserRestController',
            'SONUserRest\Controller\ComentarioRest' => 'SONUserRest\Controller\ComentarioRestController'
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