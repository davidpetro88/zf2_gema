<?php
namespace SONAcl\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MenuFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $eventManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $eventManager->getRepository('SONAcl\Entity\Menu');
    }
}