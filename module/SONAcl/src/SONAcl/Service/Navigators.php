<?php
namespace SONAcl\Service;

use SONBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Navigators extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'SONAcl\Entity\Navigator';
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setDropdown($this->em->getReference('SONAcl\Entity\Dropdown',$data["dropdowns"]));
        $entity->setRole($this->em->getReference('SONAcl\Entity\Role',$data["roles"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $entity->setDropdown($this->em->getReference('SONAcl\Entity\Dropdown',$data["dropdowns"]));
        $entity->setRole($this->em->getReference('SONAcl\Entity\Role',$data["roles"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}