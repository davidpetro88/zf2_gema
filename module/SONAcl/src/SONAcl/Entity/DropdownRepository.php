<?php
namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DropdownRepository extends EntityRepository
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
              ->from('SONAcl\Entity\Dropdown', 'r')
              ->where("r.nome like '%".$name."%'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function loadAuthAllDropDownById( $id )
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONAcl\Entity\Dropdown', 'r')
               ->where("r.id = $id")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result == null) return null;
        $result[0]->setDropdownmenu($this->loadAuthDropDownMenuById($result[0]->getId()));
        return $result[0];
    }

    public function loadAuthDropDownById( $id )
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONAcl\Entity\Dropdown', 'r')
              ->where("r.id = $id")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result[0];
        return null;
    }

    private function loadAuthDropDownMenuById($id)
    {
        return $this->_em->getRepository('SONAcl\Entity\Dropdownmenu')->loadAuthDropDownMenuById ($id);
    }
}