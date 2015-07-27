<?php

namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ResourceRepository extends EntityRepository {

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


    public function findResourceByName( $name )
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONAcl\Entity\Resource', 'r')
              ->where("r.nome = '".$name."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result[0];
        return null;
    }


}
