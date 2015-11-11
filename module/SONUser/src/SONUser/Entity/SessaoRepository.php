<?php

namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class SessaoRepository extends EntityRepository
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
        $sessoes = $this->findAll();
        $a = array();
        foreach($sessoes as $sessao)
        {
            $a[$sessao->getId()]['id'] = $sessao->getId();
            $a[$sessao->getId()]['nome'] = $sessao->getNome();
            $a[$sessao->getId()]['gerente'] = $sessao->getGerente();
            $a[$sessao->getId()]['updateAt'] = $sessao->getUpdatedAt();
            $a[$sessao->getId()]['createAt'] = $sessao->getCreatedAt();
        }
        return $a;
    }


    public function findByName( $nome )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Sessao', 'r')
              ->where("r.nome like '%".$nome."%'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findSessaoByName( $nome )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
              ->from('SONUser\Entity\Sessao', 'r')
              ->where("r.nome = '".$nome."'")
              ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result[0];
        return $array;
    }
}