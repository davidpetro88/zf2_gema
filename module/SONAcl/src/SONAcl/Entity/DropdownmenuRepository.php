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

    public function loadAuthDropDownMenuById ($id) {

        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('u'))
              ->from('SONAcl\Entity\Dropdownmenu', 'u')
              ->where("u.dropdown = $id")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);

        if ($result == null)  return $array;
        foreach($result as $key => $entity)
        {
            $array[$key] = $entity;
         //   $array[$key]->setDropdown($this->loadAuthDropDownById($array[$key]->getDropdown()->getId()));
           // $array[$key]->setMenu($this->loadAuthMenuById($array[$key]->getMenu()->getId()));
        }

        return $array;
     }

     public function loadAuthDropDownById($id) {
         return $this->_em->getRepository('SONAcl\Entity\Dropdown')->loadAuthDropDownById ($id);
     }

     public function loadAuthMenuById($id) {
         return $this->_em->getRepository('SONAcl\Entity\Menu')->loadAuthMenuById($id);
     }
}