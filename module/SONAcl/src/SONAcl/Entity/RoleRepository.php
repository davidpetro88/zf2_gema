<?php

namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Filter\Int;

class RoleRepository extends EntityRepository {

    public function fetchParent()
    {
        $entities = $this->findAll();
        $array = array();

        foreach($entities as $entity)
        {
            $array[$entity->getId()]=$entity->getNome();
        }

        return $array;
    }

    public function findRole($id)
    {
        $entities = $this->find($id);
        return $entities;
    }

}
