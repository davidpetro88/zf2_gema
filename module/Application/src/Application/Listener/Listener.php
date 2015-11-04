<?php
namespace Application\Listener;

use Zend\EventManager\Event;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

class Listener implements EventManagerAwareInterface
{
    protected $events;
    const ROLE_VISITANTE = 1;
    const PERFIL_VISITANTE = "Visitante";

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(
            __CLASS__,
            get_called_class()
        ));
        $this->events = $eventManager;
        return $this;
    }

     public function getEventManager() {
        if (null == $this->events){
            $this->setEventManager(new EventManager());
        }
        return $this->events;
     }

     public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
     {
         $this->serviceLocator = $serviceLocator;
     }

     private function getPrivilegeName (Event $event, $roleId, $resourceId) {
         $em = $event->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');
         return $em->getRepository('SONAcl\Entity\Privilege')->findPrivilege($roleId, $resourceId);
     }

     private function getResourceRepository (Event $event, $resource) {
         $sql = $event->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');//
         return $sql->getRepository('SONAcl\Entity\Resource')->findResourceByName($resource);
     }

     private function getMatchedRoute(Event $event) {
         $sm = $event->getApplication()->getServiceManager();
         $router = $sm->get('router');
         $request = $sm->get('request');
         $matchedRoute = $router->match($request);
         return is_null($matchedRoute) ? null :$matchedRoute;
     }

     private function getNameResource (Event $event) {
         $matchedRoute = $this->getMatchedRoute($event);
         if(isset($matchedRoute)) return $this->getNameFromControolerAndView ($matchedRoute);
         return null;
     }

     private function getNameFromControolerAndView ($matchedRoute){
         $params = $matchedRoute->getParams();
         $controller = isset($params['controller'])  ? $params['controller'] : null;
         $action =  isset($params['action'])  ? $params['action'] : null;
         $resource = $controller.'\\'.$action;
         //var dump
         var_dump($resource);
         return $resource;
     }

     private function getUserIdentity () {
         $auth = new AuthenticationService;
         $auth->setStorage(new SessionStorage());
         return is_null($auth->getIdentity()) ? null : $auth->getIdentity();
     }

     public function validateAuth(Event $event)
     {
         $aclPermission = $event->getApplication()->getServiceManager()->get('SONAcl\Permissions\Acl');
         $roleAuth =  $this->getUserIdentity() !=null ? $this->getUserIdentity()->getRole()->getId() : self::ROLE_VISITANTE;

         $nameResource = $this->getNameResource ($event);
         $resourceRepository = $this->getResourceRepository ($event, $nameResource);
         $perfil = $this->getUserIdentity() != null ? $this->getUserIdentity()->getRole()->getNome() : self::PERFIL_VISITANTE;

         $privilegeName = isset( $resourceRepository) ? $this->getPrivilegeName ($event, $roleAuth, $resourceRepository->getId()) : null;
         $resourceRepository = isset($resourceRepository) ? $resourceRepository->getNome() : null;

         if ($perfil != "Admin")
         {
           $permissaoIsAllowed = $aclPermission->isAllowed($perfil,$resourceRepository, $privilegeName)? "Permitido" : "Negado";
           if ($permissaoIsAllowed == "Negado") die("sem permissão");
        }
     }
}