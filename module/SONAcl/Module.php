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
                $privilege = $sm->get('privilege-factory'); /* @var $privilege \SONAcl\Entity\PrivilegeRepository  */
                $roles = $sm->get('role-factory')->fetchParent();
                $resources = $sm->get('resource-factory')->fetchPairs();
                $id = $this->getParamEdit($sm);
                if ($id){
                    $gePrivilegesKeysById = $privilege->gePrivilegesKeysById($id);
                    return new Form\Privilege("privilege", $roles, $resources, $gePrivilegesKeysById['role'], $gePrivilegesKeysById['resource']);
                }
                return new Form\Privilege("privilege", $roles, $resources);
              },
              'SONAcl\Form\Navigators' => function(ServiceManager $sm)
              {
                  $navigator = $sm->get("navigator-factory"); /* @var $navigator \SONAcl\Entity\NavigatorRepository  */
                  $roles = $sm->get('role-factory')->fetchParent();
                  $dropdown = $sm->get('dropdown-factory')->fetchParent();
                  $id = $this->getParamEdit($sm);
                  if ($id){
                      $geNavigatorsKeysById = $navigator->geNavigatorsKeysById($id);
                      return new Form\Navigators("navigators", $roles, $dropdown, $geNavigatorsKeysById['role'], $geNavigatorsKeysById['dropdown']);
                  }
                  return new Form\Navigators("navigators", $roles, $dropdown);
              },
              'SONAcl\Form\Dropdownmenu' => function(ServiceManager $sm)
              {
                  $dropDownMenu =  $sm->get('dropdownmenu-factory'); /* @var $dropDownMenu \SONAcl\Entity\DropdownmenuRepository  */
                  $dropdown = $sm->get('dropdown-factory')->fetchParent();
                  $menu = $sm->get('menu-factory')->fetchParent();
                  $id = $this->getParamEdit($sm);
                   if ($id){
                      $getDropDownMenuKeysById = $dropDownMenu->getDropDownMenuKeysById($id);
                      return new Form\Dropdownmenu("dropdownmenu", $dropdown, $menu, $getDropDownMenuKeysById['menu'], $getDropDownMenuKeysById['dropdown']);
                  }
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

    private function getParamEdit(ServiceManager $sm) {
        $matchedRoute = $this->getMatchedRoute($sm);
        $params = $matchedRoute->getParams();
        return isset($params['id']) ? $params['id'] : null;
    }

    private function getMatchedRoute(ServiceManager $sm) {
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        return is_null($matchedRoute) ? null :$matchedRoute;
    }
}