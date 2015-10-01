<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SONUser;

use Zend\Mvc\MvcEvent;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use SONUser\Auth\Adapter as AuthAdapter;
use Zend\ModuleManager\ModuleManager;
use Zend\Stdlib\Hydrator\Filter\OptionalParametersFilter;



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

  public function init(ModuleManager $moduleManager) {
        #buscando os eventos compartilhados
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        #associando um evento (validaAuth) ao dispath
        $sharedEvents->attach(
                "Zend\Mvc\Controller\AbstractActionController",
                MvcEvent::EVENT_DISPATCH,
                array($this, 'validaAuth'),
                100); #100 é a prioridade
  }

    public function validaAuth($e)
    {
        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
        if(!$this->getUserIdentity() and ($matchedRoute == "sonuser-admin" ||
                                          $matchedRoute == "sonuser-admin/paginator"))
            return $controller->redirect()->toRoute("sonuser-auth");
    }

    public function getServiceConfig()
    {
        return array(
          'factories' => array(
              'SONUser\Mail\Transport' => function($sm) {
                $config = $sm->get('Config');
                $transport = new SmtpTransport();
                $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                return $transport;
              },
              'SONUser\Form\Materia' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $repoUser = $em->getRepository('SONUser\Entity\User');
                  $users = $repoUser->findByIdFormInsert($this->getUserIdentity());

                  $repoSessao = $em->getRepository('SONUser\Entity\Sessao');
                  $sessao = $repoSessao->fetchPairs();

                  $repoStatus = $em->getRepository('SONUser\Entity\Status');
                  if ($id = $this->getParamEdit($sm)) {
                      $statusCanBeEdit = $this->getStatusEditFromMateria($em, $id);
                      $status = $statusCanBeEdit['status'];
                  }else {
                      $status = $repoStatus->findStatusByNameFormInsert("PROPOSTA");
                  }

                  return new Form\Materia("Materia",$users, $sessao, $status);
              },
              'SONUser\Form\Status' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $nextStatus = null; $backStatus = null;
                  $repoStatus = $em->getRepository('SONUser\Entity\Status');
                  $status = $repoStatus->fetchPairs();
                  if ($id = $this->getParamEdit($sm)) {
                      $arrayEntityStatus = $this->getStatusEdit($em, $id);
                      $nextStatus = $arrayEntityStatus['nextStatus'];
                      $backStatus = $arrayEntityStatus['backStatus'];
                  }
                return new Form\Status("Status",$status, $nextStatus,$backStatus );
              },
              'SONUser\Form\User' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $repoRole = $em->getRepository('SONAcl\Entity\Role');
                  $roleSelected = null;
                  if ($id = $this->getParamEdit($sm)) {
                      $roleSelected = $repoRole->findByIdForm( $id );
                  }
                  $role = $repoRole->fetchParent();
                  return new Form\User("user",null, $role,$roleSelected);

              },
              'SONUser\Service\Materia' => function($sm){
                return new Service\Materia($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONUser\Form\Sessao' => function($sm)
              {
                 $em = $sm->get('Doctrine\ORM\EntityManager');
                 $repoUser = $em->getRepository('SONUser\Entity\User');
                 $users = $repoUser->fetchPairs();
                return new Form\Sessao("sessao",$users);
              },
              'SONUser\Form\Capa' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $repoUser = $em->getRepository('SONUser\Entity\User');
                  $users = $repoUser->findByIdFormInsert($this->getUserIdentity());

                  $repoMateria = $em->getRepository('SONUser\Entity\Materia');
                  $materia = $repoMateria->getMateriasToCapa();

                  return new Form\Capa("Capa",$users, $materia);
              },
              'SONUser\Service\Sessao' => function($sm){
                return new Service\Sessao($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'SONUser\Service\Capa' => function($sm){
                return new Service\Capa($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONUser\Service\Status' => function($sm){
                return new Service\Status($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONUser\Service\Comentario' => function($sm){
              return new Service\Comentario($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'SONUser\Service\User' => function($sm) {
                  $sm->get('SONUser\Mail\Transport');
                  return new Service\User($sm->get('Doctrine\ORM\EntityManager'),
                                          $sm->get('SONUser\Mail\Transport'),
                                          $sm->get('View'));
              },
              'SONUser\Auth\Adapter' => function($sm)
              {
                  return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
              }
          )
        );

    }

    private function getStatusEditFromMateria ($em, $id) {
       $getMateria = $em->getRepository("SONUser\\Entity\\Materia");
       $arrayMateria = $getMateria->find($id)->toArray();
       return array( "status" => ($arrayMateria["status"] !=null) ? $this->getStatusEditToEditMateria($em,$arrayMateria["status"]->getId()): null);
    }

    private function getStatusEditToEditMateria($em, $id){
        return $em->getRepository('SONUser\Entity\Status')->findStatusToeditMateria( $id );
    }

    private function getStatusEdit($em, $id)
    {
       $arrayStatus = $em->getRepository('SONUser\Entity\Status')->find($id)->toArray();
       return array("nextStatus" => ($arrayStatus["next_status"] !=null) ? $arrayStatus["next_status"]->getId(): null,
                    "backStatus" => ($arrayStatus["back_status"] !=null) ? $arrayStatus["back_status"]->getId(): null);
    }

    private function getMatchedRoute($sm) {
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        return is_null($matchedRoute) ? null :$matchedRoute;
    }

    private function getParamEdit($sm) {
        $matchedRoute = $this->getMatchedRoute($sm);
        $params = $matchedRoute->getParams();
        return isset($params['id']) ? $params['id'] : null;
    }

    private function getUserIdentity () {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        return is_null($auth->getIdentity()) ? null : $auth->getIdentity()->getId();
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
            'UserIdentity' => new View\Helper\UserIdentity(),
            'formLabel' => 'SONUser\Form\View\Helper\FormLabel',
            'fieldCollection' => 'SONUser\Form\View\Helper\FieldCollection',
            'fieldRow' => 'SONUser\Form\View\Helper\FieldRow',
            )
        );
    }
}