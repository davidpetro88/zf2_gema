<?php

namespace SONAcl;

use Zend\ServiceManager\ServiceManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
          'factories' => array(
              'SONAcl\Form\Role' => function(ServiceManager $sm)
              {
                return new Form\Role('role', $sm->get('role-factory')->fetchParent());
              },
              'SONAcl\Form\Privilege' => function(ServiceManager $sm)
              {
                $roles = $sm->get('role-factory')->fetchParent();
                $resources = $sm->get('resource-factory')->fetchPairs();
                return new Form\Privilege("privilege", $roles, $resources);
              },
              'SONAcl\Form\Navigators' => function(ServiceManager $sm)
              {
                  $roles = $sm->get('role-factory')->fetchParent();
                  $dropdown = $sm->get('dropdown-factory')->fetchParent();
                  return new Form\Navigators("navigators", $roles, $dropdown);
              },
              'SONAcl\Form\Dropdownmenu' => function(ServiceManager $sm)
              {
                  $dropdown = $sm->get('dropdown-factory')->fetchParent();
                  $menu = $sm->get('menu-factory')->fetchParent();
                  return new Form\Dropdownmenu("dropdownmenu", $dropdown, $menu);
              },
              'SONAcl\Service\Role' => function(ServiceManager $sm){
                  return new Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Resource' => function(ServiceManager $sm){
                  return new Service\Resource($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Privilege' => function(ServiceManager $sm){
                  return new Service\Privilege($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Menu' => function(ServiceManager $sm){
                  return new Service\Menu($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Dropdown' => function(ServiceManager $sm){
                  return new Service\Dropdown($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Dropdownmenu' => function(ServiceManager $sm){
                  return new Service\Dropdownmenu($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Navigators' => function(ServiceManager $sm){
                  return new Service\Navigators($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Permissions\Acl' => function(ServiceManager $sm)
              {
                  $roles = $sm->get('role-factory')->findAll();
                  $resources = $sm->get('resource-factory')->findAll();
                  $privileges = $sm->get('privilege-factory')->findAll();
                  return new Permissions\Acl($roles,$resources,$privileges);
              }
          )
        );
    }
}