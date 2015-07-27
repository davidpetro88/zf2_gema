<?php
namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ComentarioRepository extends EntityRepository
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


    public function findArray()
    {
        $comentarios = $this->findAll();
        $a = array();
        foreach($comentarios as $comentario)
        {
            $a[$comentario->getId()]['id'] = $comentario->getId();
            $a[$comentario->getId()]['idMateria'] = $comentario->getTitulo();
            $a[$comentario->getId()]['autor'] = $comentario->getAutor();
            $a[$comentario->getId()]['comentario'] = $comentario->getComentario();
            $a[$comentario->getId()]['updatedAt'] = $comentario->getUpdatedAt();
            $a[$comentario->getId()]['createdAt'] = $comentario->getCreatedAt();
        }
        return $a;
    }

    public function findByIdArray($id)
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Comentario', 'r')
              ->where("r.id = '".$id."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null){
            $array[$result[0]->getId()]['id'] = $result[0]->getId();
            $array[$result[0]->getId()]['idMateria'] = $result[0]->getIdMateria();
            $array[$result[0]->getId()]['autor'] = $result[0]->getAutor();
            $array[$result[0]->getId()]['comentario'] = $result[0]->getComentario();
            $array[$result[0]->getId()]['updatedAt'] = $result[0]->getUpdatedAt();
            $array[$result[0]->getId()]['createdAt'] = $result[0]->getCreatedAt();
        }
        return $array;
    }

    public function getListComentarioFromMateria ($idMateira) {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Comentario', 'r')
              ->where("r.idMateria = '".$idMateira."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        foreach($result as $key => $comentario){
            $array[$key]['id'] = $comentario->getId();
            $array[$key]['idMateria'] = $comentario->getIdMateria();
            $array[$key]['autor'] = $comentario->getAutor();
            $array[$key]['comentario'] = $comentario->getComentario();
            $array[$key]['updatedAt'] = $comentario->getUpdatedAt();
            $array[$key]['createdAt'] = $comentario->getCreatedAt();
        }
        return $array;
    }

    public function getQuantityComentariosByMateria($id) {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('count(r)'))
              ->from('SONUser\Entity\Comentario', 'r')
              ->where("r.idMateria = '".$id."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result[0][1];
        return 0;
    }
}