<?php
namespace SONUser\Service;

use SONBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

class Materia extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "SONUser\\Entity\\Materia";
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);

        $entity->setAutor($this->em->getReference("SONUser\\Entity\\User",$data["autor"]));
        $entity->setSessao($this->em->getReference("SONUser\\Entity\\Sessao",$data["sessao"]));
        $entity->setStatus($this->em->getReference("SONUser\\Entity\\Status",$data["status"]));

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        if($data['status'] == 2) {
            $entity->setRevisor($this->em->getReference("SONUser\\Entity\\User",$this->getUserIdentity ()));
        } else if ($data['status'] == 3) {
            $entity->setPublicador($this->em->getReference("SONUser\\Entity\\User",$this->getUserIdentity ()));
        }
        $entity->setAutor($this->em->getReference("SONUser\\Entity\\User",$data["autor"]));
        $entity->setSessao($this->em->getReference("SONUser\\Entity\\Sessao",$data["sessao"]));
        $entity->setStatus($this->em->getReference("SONUser\\Entity\\Status",$data["status"]));

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    private function getUserIdentity () {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        if(is_null($auth->getIdentity())) return null;
        return $auth->getIdentity()->getId();
    }
}