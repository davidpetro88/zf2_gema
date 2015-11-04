<?php

namespace SONAcl\Service;

use SONBase\Service\AbstractService;

class Dropdownmenu extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'SONAcl\Entity\Dropdownmenu';
    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setDropdown($this->em->getReference('SONAcl\Entity\Dropdown',$data["dropdown"]));
        $entity->setMenu($this->em->getReference('SONAcl\Entity\Menu',$data["menu"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}