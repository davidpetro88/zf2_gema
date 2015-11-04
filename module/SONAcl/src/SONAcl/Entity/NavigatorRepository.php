<?php

namespace SONAcl\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class NavigatorRepository extends EntityRepository
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

    public function getNavigatorByRoleId ($roleId) {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('u'))
              ->from('SONAcl\Entity\Navigator', 'u')
              ->where("u.role = $roleId")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result == null)  return $array;
        foreach($result as $key => $entity)
        {
            $array[$key] = $entity;
            $array[$key]->setDropdown($this->loadAuthAllDropDownById($array[$key]->getDropdown()->getId()));
        }
        return $array;
    }

    public function findByRole ($roleId) {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('u'))
              ->from('SONAcl\Entity\Navigator', 'u')
              ->where("r.role = $roleId")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);
        if ($result != null) return $result;
        return null;
    }

    private function loadAuthAllDropDownById($id)
    {
        return $this->_em->getRepository('SONAcl\Entity\Dropdown')->loadAuthAllDropDownById ($id);
    }
}