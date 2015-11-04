<?php

namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;


class PrivilegeRepository extends EntityRepository
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

    public function findByName( $name )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONAcl\Entity\Privilege', 'r')
             ->where("r.nome like '%".$name."%'")
             ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findPrivilege($roleId, $resourceId)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('u', 'r','rl'))
               ->from('SONAcl\Entity\Privilege', 'u')
               ->join('u.resource', 'r')
               ->join('u.role', 'rl')
               ->where("u.role = $roleId")
               ->andWhere("u.resource = $resourceId")
               ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);
        if ($result != null) return $result[0]['nome'];
        return null;
    }
}