<?php

namespace SONAcl;

return array(
    'router' => array(
        'routes' => array(
            'sonacl-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/acl',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'Roles',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Roles'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Roles'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Roles',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-privilege' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/privilege',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'Privileges',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'privileges'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'privileges'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Privileges',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-resource' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/resource',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'Resources',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Resources'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Resources'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'Resources',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-dropdown' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/dropdown',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'Dropdown',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdown'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdown'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdown',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-dropdownmenu' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/dropdownmenu',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'dropdownmenu',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdownmenu'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdownmenu'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'dropdownmenu',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-menu' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/menu',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'Menu',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'menu'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'menu'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'menu',
                                'action'     => 'index',
                            ),
                        ),
                    )
                )
            ),
            'sonacl-admin-navigator' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/navigator',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONAcl\Controller',
                        'controller' => 'navigators',
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'navigators'
                            )
                        )
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'navigators'
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
                                '__NAMESPACE__' => 'SONAcl\Controller',
                                'controller' => 'navigators',
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
            'navigator-factory' => 'SONAcl\Factory\NavigatorFactory',
            'role-factory' => 'SONAcl\Factory\RoleFactory',
            'resource-factory' => 'SONAcl\Factory\ResourceFactory',
            'dropdown-factory' => 'SONAcl\Factory\DropdownFactory',
            'menu-factory' => 'SONAcl\Factory\MenuFactory',
            'privilege-factory' => 'SONAcl\Factory\PrivilegeFactory',
            'dropdownmenu-factory'  => 'SONAcl\Factory\DropdownmenuFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'SONAcl\Controller\Roles' => 'SONAcl\Controller\RolesController',
            'SONAcl\Controller\Resources' => 'SONAcl\Controller\ResourcesController',
            'SONAcl\Controller\Privileges' => 'SONAcl\Controller\PrivilegesController',
            'SONAcl\Controller\Navigators' => 'SONAcl\Controller\NavigatorsController',
            'SONAcl\Controller\Dropdown' => 'SONAcl\Controller\DropdownController',
            'SONAcl\Controller\Menu' => 'SONAcl\Controller\MenuController',
            'SONAcl\Controller\Dropdownmenu' => 'SONAcl\Controller\DropdownmenuController',
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