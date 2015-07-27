<?php
namespace SONAclTest\Controller;

use SONAclTest\ControllerTestCase;
use SONAcl\Controller\PrivilegesController;
use Zend\Http\Request;
use Zend\Stdlib\Parameters;
use Zend\View\Renderer\PhpRenderer;

class PrivilegesControllerTest extends ControllerTestCase
{
    protected $controllerFQDN = 'SONAcl\Controller\PrivilegesController';
    protected $controllerRoute = 'sonacl-admin-privilege';

    public function test_erro404()
    {

        $this->routeMatch->setParam('action','actionNaoExiste');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(404,$response->getStatusCode());
    }

//     public function test_indexAction()
//     {
//         $this->routeMatch->setParam('action','index');
//         $result = $this->controller->dispatch($this->request,$this->response);
//         // testar o codigo 200
//         $response = $this->controller->getResponse();
//         $this->assertEquals(200, $response->getStatusCode());


//     }

}