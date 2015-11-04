<?php
namespace SONUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CapaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $eventManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $eventManager->getRepository('SONUser\Entity\Capa');
    }
}