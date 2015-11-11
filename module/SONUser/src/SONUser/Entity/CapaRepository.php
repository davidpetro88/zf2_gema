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

    public function getCapaById($id) {
        $capa = $this->find($id);
        if(!empty($capa)) return array ( 'capa_principal' => $capa->getCapaPrincipal(), 'ativo' => $capa->getAtivo());
        return null;
    }

    public function findArray()
    {
        $capas = $this->findAll();
        $a = array();
        foreach($capas as $capa)
        {
            $a[$capa->getId()]['id'] = $capa->getId();
            $a[$capa->getId()]['materia'] = $capa->getMateria()->getId();
            $a[$capa->getId()]['capaPrincipal'] = $capa->getCapaPrincipal();
            $a[$capa->getId()]['ativo'] = $capa->getAtivo();
            $a[$capa->getId()]['usuario'] = $capa->getUsuario()->getId();
            $a[$capa->getId()]['updateAt'] = $capa->getUpdatedAt();
            $a[$capa->getId()]['createAt'] = $capa->getCreatedAt();
        }
        return $a;
    }

    public function findByIdArray($id){
        $capa = $this->find($id);
        if (empty($capa)) return null;
            $a = array();
            $a[$capa->getId()]['id'] = $capa->getId();
            $a[$capa->getId()]['materia'] = $capa->getMateria()->getId();
            $a[$capa->getId()]['capaPrincipal'] = $capa->getCapaPrincipal();
            $a[$capa->getId()]['ativo'] = $capa->getAtivo();
            $a[$capa->getId()]['usuario'] = $capa->getUsuario()->getId();
            $a[$capa->getId()]['updateAt'] = $capa->getUpdatedAt();
            $a[$capa->getId()]['createAt'] = $capa->getCreatedAt();
        return $a;
    }

    public function findOneRandom()
    {
        $em = $this->getEntityManager();
        $getCapa = $em->createQuery('SELECT c.id FROM SONUser\Entity\Capa c
                                     WHERE c.capaPrincipal = 1
                                     AND c.ativo = 1');
        $result = $getCapa->getResult(Query::HYDRATE_OBJECT);
        if (empty($result)) {
            return null;
        }

      return $this->findById( $result[array_rand($result)]['id'] );
    }

    public function findListRandom()
    {
       $array = array();
       $queryResult =  $this->createQueryBuilder('q')
                            ->select(array('q'))
                            ->where('q.capaPrincipal = 0 AND q.ativo = 1')
                            ->getQuery()
                            ->getResult();
        if(empty($queryResult)) return null;
        array_walk($queryResult, function($val,$key) use(&$array){
               $array[$key] = $val->getId();
        });
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
           if ($key <= 40) {
                $arrayMateria[$key] = $this->findById( $randMateriaId );
           }
        }
        return $arrayMateria;
    }
}