<?php
namespace SONUser\Entity;

namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CapaRepository extends EntityRepository
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

    public function findOneRandom()
    {
        $idMapper = $this->createQueryBuilder('q')
                         ->select(array('q.id'))
                         ->where('q.capaPrincipal = 1 AND q.ativo = 1')
                         ->getQuery()
                         ->getResult();
        if (empty($idMapper)) {
            return null;
        }
      return $this->findById( $idMapper[array_rand($idMapper)]['id'] );
    }

    public function findListRandom()
    {
       $queryResult =  $this->createQueryBuilder('q')
                            ->select(array('q'))
                            ->where('q.capaPrincipal = 0 AND q.ativo = 1')
                            ->getQuery()
                            ->getResult();
       if(empty($queryResult))return null;
       $array = array();
        foreach($queryResult as $key => $entity )
            $array[$key] = $entity->getId();

        return $this->getMateriaByArrayId($this->shuffle_assoc($array));
    }


    public function findById( $id )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONUser\Entity\Capa', 'r')
        ->where("r.id = '".$id."'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result[0];
        return $array;
    }

    private function shuffle_assoc($list) {
        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key)
            $random[$key] = $list[$key];

        return $random;
    }

    private function getMateriaByArrayId (array $arrayId = null) {
        if ($arrayId == null) return null;
        $arrayMateria = array();
        foreach ($arrayId as $key => $randMateriaId){
            if ($key <= 8) {
                $arrayMateria[$key] = $this->findById( $randMateriaId );
            }
        }
        return $arrayMateria;
    }


}