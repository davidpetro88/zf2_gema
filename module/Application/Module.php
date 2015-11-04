<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

class Module
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $mvcEvent->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $mvcEvent->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);

        $serviceManager = $mvcEvent->getApplication()->getServiceManager();
        $listernerFactory = $serviceManager->get("listener-factory");
        $listernerFactory->getEventManager()->attach('validateAuth',function($mvcEvent){ echo $mvcEvent->getName(); die("DAVID"); });
        $listernerFactory->validateAuth($mvcEvent);
    }

    public function onDispatch(MvcEvent $mvcEvent)
    {
        $serviceManager = $mvcEvent->getApplication()->getServiceManager();
        $viewModel = $mvcEvent->getViewModel();
        $roleId = $this->getUserIdentityRole($mvcEvent);
        if ($roleId) $navigator = $serviceManager->get('navigator-factory')->getNavigatorByRoleId($roleId);
        $viewModel->setVariable("navigator",$navigator);
    }

    private function getUserIdentityRole (MvcEvent $mvcEvent) {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        $serviceManager = $mvcEvent->getApplication()->getServiceManager();
        if(is_null($auth->getIdentity())) return null;
        /* @var $role \SONUser\Entity\UserRepository  */
        $role = $serviceManager->get('user-factory');
        return $role->getRoleIdUser($auth->getIdentity()->getId());
    }

    public function bootstrapSession($e)
    {
        $session = $e->getApplication()->getServiceManager()->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');
        if (!isset($container->init)) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $request        = $serviceManager->get('Request');

            $session->regenerateId(true);
            $container->init          = 1;
            $container->remoteAddr    = $request->getServer()->get('REMOTE_ADDR');
            $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');

            $config = $serviceManager->get('Config');
            if (!isset($config['session'])) {
                return;
            }

            $sessionConfig = $config['session'];
            if (isset($sessionConfig['validators'])) {
                $chain   = $session->getValidatorChain();

                foreach ($sessionConfig['validators'] as $validator) {
                    switch ($validator) {
                        case 'Zend\Session\Validator\HttpUserAgent':
                            $validator = new $validator($container->httpUserAgent);
                            break;
                        case 'Zend\Session\Validator\RemoteAddr':
                            $validator  = new $validator($container->remoteAddr);
                            break;
                        default:
                            $validator = new $validator();
                    }
                    $chain->attach('session.validate', array($validator, 'isValid'));
                }
            }
        }
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];
                        $sessionConfig = null;
                        if (isset($session['config'])) {
                            $class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }
                        $sessionStorage = null;
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }
                        $sessionSaveHandler = null;
                        if (isset($session['save_handler'])) {
                            // class should be fetched from service manager since it will require constructor arguments
                            $sessionSaveHandler = $sm->get($session['save_handler']);
                        }
                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);
                    } else {
                        $sessionManager = new SessionManager();
                    }
                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
            ),
        );
    }

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
}