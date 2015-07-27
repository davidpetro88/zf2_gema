<?php

namespace SONUser\Service;

use SONBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Sessao extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "SONUser\\Entity\\Sessao";
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);

        if($data['Gerente'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\User",$data['Gerente']);
            $entity->setGerente($user); // Injetando entidade carregada
        } else {
            $entity->setGerente(null);
        }


        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        if($data['Gerente'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\User",$data['Gerente']);
            $entity->setGerente($user); // Injetando entidade carregada
        } else {
            $entity->setGerente(null);
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }



}
