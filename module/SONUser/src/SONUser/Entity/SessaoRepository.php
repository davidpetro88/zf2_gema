<?php

namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;

class SessaoRepository extends EntityRepository
{
    public function fetchPairs()
    {
        $entities = $this->findAll();
        $array = array();
        foreach($entities as $entity)
        {
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }
}
