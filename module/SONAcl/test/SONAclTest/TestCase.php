<?php
namespace SONAclTest;

use SONAclTest\Bootstrap;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\Mvc\MvcEvent;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use PHPUnit_Framework_TestCase;

chdir(__DIR__);

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var EntityManager
     */
    protected $em;

    protected $modules;


    public function setup() {

        parent::setup();

        $pathDir = getcwd()."/../../../../";

        $config = include $pathDir.'config/application.config.php';
        $this->serviceManager = new ServiceManager(new ServiceManagerConfig(
            isset($config['service_manager']) ? $config['service_manager'] : array()
        ));
        $this->serviceManager->setService('ApplicationConfig', $config);
        $this->serviceManager->setFactory('ServiceListener', 'Zend\Mvc\Service\ServiceListenerFactory');

        $moduleManager = $this->serviceManager->get('ModuleManager');
        $this->routes = array();
        $this->modules = $moduleManager->getModules();
        $this->serviceManager->setAllowOverride(true);
        $this->serviceManager = Bootstrap::getServiceManager();
        $this->application = $this->serviceManager->get('Application');

        $this->event = new MvcEvent();
        $this->event->setTarget($this->application);
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
        $this->event->setApplication($this->application)
                    ->setRequest($this->application->getRequest())
                    ->setResponse($this->application->getResponse())
                    ->setRouter($router);
//                     ->setRouter($this->serviceManager->get('Router'));

        foreach($this->filterModules() as $m)
            $this->createDatabase($m);
    }

    private function filterModules()
    {
        $array = array();
        foreach($this->modules as $m) {
           if ($m <> "DoctrineModule" and $m <> "DoctrineORMModule"  and $m <> "DoctrineDataFixtureModule")
                $array[] = $m;
        }
        return $array;
    }

    public function createDatabase($module) {
        if (file_exists(getcwd().'/module/' . $module . '/db/create.sql')) {
            $sql = file(getcwd().'/module/' . $module . '/db/create.sql');
            foreach ($sql as $s) {
                $this->getEm()->getConnection()->exec($s);
            }
            $this->getEm()->getConnection()->exec('SET FOREIGN_KEY_CHECKS = 0;');
        }
    }

    public function tearDown() {
        parent::tearDown();
        foreach($this->filterModules()  as $m)
        {
            if (file_exists(getcwd().'/module/' . $m . '/db/drop.sql')) {
                $sql = file(getcwd().'/module/' . $m . '/db/drop.sql');
                foreach ($sql as $s) {
                    $this->getEm()->getConnection()->exec($s);
                }
            }
        }
    }

    public function getEm() {
        return $this->em = $this->serviceManager->get('doctrine.entitymanager.orm_default');
    }
}