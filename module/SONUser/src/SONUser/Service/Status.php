<?php

namespace SONUser\Service;

use SONBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Status extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "SONUser\\Entity\\Status";
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setNextStatus($this->em->getReference("SONUser\\Entity\\Status",$data["nextStatus"]));
        $entity->setBackStatus($this->em->getReference("SONUser\\Entity\\Status",$data["backStatus"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $entity->setNextStatus($this->em->getReference("SONUser\\Entity\\Status",$data["nextStatus"]));
        $entity->setBackStatus($this->em->getReference("SONUser\\Entity\\Status",$data["backStatus"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}