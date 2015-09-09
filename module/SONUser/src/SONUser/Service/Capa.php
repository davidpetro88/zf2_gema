<?php
namespace SONUser\Service;

use SONBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Capa extends AbstractService
{

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'SONUser\Entity\Capa';
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setCapaPrincipal($data['capa']);
        if($data['usuario'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\User",$data['usuario']);
            $entity->setUsuario($user); // Injetando entidade carregada
        } else {
            $entity->setUsuario(null);
        }

        if($data['materia'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\Materia",$data['materia']);
            $entity->setMateria($user); // Injetando entidade carregada
        } else {
            $entity->setMateria(null);
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $entity->setCapaPrincipal($data['capa']);
        $entity->setAtivo($data['ativo']);
        if($data['usuario'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\User",$data['usuario']);
            $entity->setUsuario($user); // Injetando entidade carregada
        }

        if($data['materia'])
        {
            $user = $this->em->getReference("SONUser\\Entity\\Materia",$data['materia']);
            $entity->setMateria($user); // Injetando entidade carregada
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}