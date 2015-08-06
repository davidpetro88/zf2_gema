<?php
namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DropdownmenuRepository extends EntityRepository
{
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
        ->from('SONAcl\Entity\Dropdownmenu', 'r')
        ->where("r.nome like '%".$name."%'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findDropDownMenuAuth ($id) {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('u'))
              ->from('SONAcl\Entity\Dropdownmenu', 'u')
              ->where("u.dropdown = $id")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);
        if ($result != null) return $result;
        return null;
        }

}