<?php

namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

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

    public function findByName( $name )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONAcl\Entity\Role', 'r')
        ->where("r.nome like '%".$name."%'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findById( $id )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONAcl\Entity\Role', 'r')
        ->where("r.id = ".$id."")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result == null)  return $array;
        foreach($result as $key => $entity)
        {
            $array[$key] = $entity;
            $array[$key]->setNavigator($this->findNavigators($array[$key]->getId()));
        }

        return $array;
    }

    public function findRoleByIdAuth ( $id )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONAcl\Entity\Role', 'r')
        ->where("r.id = ".$id."")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result == null)  return $array;
        foreach($result as $key => $entity)
        {
            $array[$key] = $entity;
            $array[$key]->setNavigator($this->findNavigators($array[$key]->getId()));
        }

        return $array;
    }







    public function findByIdForm( $id )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONAcl\Entity\Role', 'r')
        ->where("r.id = '".$id."'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) $array[$result[0]->getId()] = $result[0]->getNome();
        return $array;
    }


    private function findNavigators($id)
    {
        return $this->_em->getRepository('SONAcl\Entity\Navigator')->getNavigatorByRoleId ($id);
    }

}
