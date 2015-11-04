<?php
namespace SONUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComentarioFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $eventManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $eventManager->getRepository('SONUser\Entity\Comentario');
    }
}