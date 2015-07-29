<?php
namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class MateriaRepository extends EntityRepository
{
    public function fetchPairs()
    {
        $entities = $this->findAll();
        $array = array();
        foreach($entities as $entity)
        {
            $array[$entity->getId()] = $entity->getTitulo();
        }
        return $array;
    }

    public function findArray()
    {
        $materias = $this->findAll();
        $a = array();
        foreach($materias as $materia)
        {
            $a[$materia->getId()]['id'] = $materia->getId();
            $a[$materia->getId()]['titulo'] = $materia->getTitulo();
            $a[$materia->getId()]['url_materia'] = $materia->getUrlMateria();
            $a[$materia->getId()]['conteudo'] = $materia->getConteudo();
            $a[$materia->getId()]['status'] = $materia->getStatus();
            $a[$materia->getId()]['autor'] = $materia->getAutor();
            $a[$materia->getId()]['sessao'] = $materia->getSessao();
            $a[$materia->getId()]['updatedAt'] = $materia->getUpdatedAt();
            $a[$materia->getId()]['createdAt'] = $materia->getCreatedAt();
        }
        return $a;
    }

    public function validateIsRegistered ($urlMateria) {
        $resultQuery = $this->createQueryBuilder('q')
                         ->select(array('q.id'))
                         ->where("q.urlMateria = '".$urlMateria."'")
                         ->getQuery()
                         ->getResult();
        if (empty($resultQuery)) {
            return null;
        }
        return $this->findById($resultQuery[0]['id'] );
      }


      public function findById( $id )
      {
          $array = array();
          $query = $this->getEntityManager()->createQueryBuilder();
          $query->select(array('r'))
                ->from('SONUser\Entity\Materia', 'r')
                ->where("r.id = '".$id."'")
                ->getQuery();
          $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
          if ($result != null) return $result[0];
          return $array;
      }

      public function findByTitulo( $titulo )
      {
          $array = array();
          $query = $this->getEntityManager()->createQueryBuilder();
          $query->select(array('r'))
          ->from('SONUser\Entity\Materia', 'r')
          ->where("r.titulo like '%".$titulo."%'")
          ->getQuery();
          $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
          if ($result != null) return $result;
          return $array;
      }




      public function findByUrl( $urlMateria )
      {
          $array = array();
          $query = $this->getEntityManager()->createQueryBuilder();
          $query->select(array('r'))
                ->from('SONUser\Entity\Materia', 'r')
                ->where("r.urlMateria = '".$urlMateria."'")
                ->getQuery();
          $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
          if ($result != null) return $result[0];
          return $array;
      }


      public function getNextId ()
      {
          $array = array();
          $query = $this->getEntityManager()->createQueryBuilder();
          $query->select(array('max(r.id) AS id'))
                ->from('SONUser\Entity\Materia', 'r')
                ->getQuery();
          $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
          if ($result != null) return $result[0]['id']+1;
          return null;
      }
}