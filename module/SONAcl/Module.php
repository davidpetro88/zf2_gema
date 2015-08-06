<?php

namespace SONAcl;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

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
              'SONAcl\Form\Role' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('SONAcl\Entity\Role');
                $parent = $repo->fetchParent();

                return new Form\Role('role',$parent);
              },
              'SONAcl\Form\Privilege' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repoRoles = $em->getRepository('SONAcl\Entity\Role');
                $roles = $repoRoles->fetchParent();

                $repoResources = $em->getRepository('SONAcl\Entity\Resource');
                $resources = $repoResources->fetchPairs();

                return new Form\Privilege("privilege", $roles, $resources);
              },
              'SONAcl\Form\Navigators' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $roles = $em->getRepository('SONAcl\Entity\Role')->fetchParent();
                  $dropdown = $em->getRepository('SONAcl\Entity\Dropdown')->fetchParent();

                  return new Form\Navigators("navigators", $roles, $dropdown);
              },
              'SONAcl\Form\Dropdownmenu' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $dropdown = $em->getRepository('SONAcl\Entity\Dropdown')->fetchParent();
                  $menu = $em->getRepository('SONAcl\Entity\Menu')->fetchParent();

                  return new Form\Dropdownmenu("dropdownmenu", $dropdown, $menu);
              },

              'SONAcl\Service\Role' => function($sm){
                return new Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Resource' => function($sm){
                return new Service\Resource($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Privilege' => function($sm){
                return new Service\Privilege($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Menu' => function($sm){
                return new Service\Menu($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Dropdown' => function($sm){
                return new Service\Dropdown($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Dropdownmenu' => function($sm){
              return new Service\Dropdownmenu($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Service\Navigators' => function($sm){
              return new Service\Navigators($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONAcl\Permissions\Acl' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');

                  $repoRole = $em->getRepository('SONAcl\Entity\Role');
                  $roles = $repoRole->findAll();

                  $repoResource = $em->getRepository('SONAcl\Entity\Resource');
                  $resources = $repoResource->findAll();

                  $repoPrivilege = $em->getRepository('SONAcl\Entity\Privilege');
                  $privileges = $repoPrivilege->findAll();

                  return new Permissions\Acl($roles,$resources,$privileges);
              }
          )
        );

    }

}
