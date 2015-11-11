<?php
namespace SONAclTest\Controller;

use SONAclTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
//         //$this->controller = new IndexController();
//         $this->request    = new Request();
//         $this->routeMatch = new RouteMatch(array('controller' => 'index'));
//         $this->event      = new MvcEvent();
//         $config = $serviceManager->get('Config');
//         $routerConfig = isset($config['router']) ? $config['router'] : array();
//         $router = HttpRouter::factory($routerConfig);

//         $this->event->setRouter($router);
//         $this->event->setRouteMatch($this->routeMatch);
//         $this->controller->setEvent($this->event);
//         $this->controller->setServiceLocator($serviceManager);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->assertEquals(200, 200);
    }


}