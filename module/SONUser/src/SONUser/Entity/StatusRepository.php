<?php
namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class StatusRepository extends EntityRepository
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

    public function findByName( $nome )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONUser\Entity\Status', 'r')
        ->where("r.nome like '%".$nome."%'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findStatusByNameFormInsert( $name )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Status', 'r')
              ->where("r.nome = '".$name."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) $array[$result[0]->getId()] = $result[0]->getNome();
        return $array;
    }

    public function findStatusByIdFormInsert( $id )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Status', 'r')
              ->where("r.id = '".$id."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) $array[$result[0]->getId()] = $result[0]->getNome();
        return $array;
    }

    public function findStatusToeditMateria( $id )
    {
        $array = array();
        $entities = $this->find($id);
        $entitiesToArray = $entities->toArray();

        if (!empty($entitiesToArray["back_status"]))$array[$entitiesToArray["back_status"]->getId()] = $entitiesToArray["back_status"]->getNome();
        if (!empty($entitiesToArray["next_status"]))$array[$entitiesToArray["next_status"]->getId()] = $entitiesToArray["next_status"]->getNome();

        return $array;
    }
}
