<?php

namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class UserRepository extends EntityRepository
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

    public function findByName( $name )
    {
        $array = array();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(array('r'))
        ->from('SONUser\Entity\User', 'r')
        ->where("r.nome like '%".$name."%'")
        ->getQuery();
        $result = $query->getQuery()->getResult(Query::HYDRATE_OBJECT);
        if ($result != null) return $result;
        return $array;
    }

    public function findByIdFormInsert($id)
    {
        $array = array();
        $entities = $this->find($id);
        if ($entities != null) $array[$entities->getId()] = $entities->getNome();
        return $array;
    }


    public function findByEmailAndPassword($email, $password)
    {
        $user = $this->findOneByEmail($email);

        if($user)
        {
            $user->setRole($this->findRoleById($user->getRole()->getId()));
            $hashSenha = $user->encryptPassword($password);
            if($hashSenha == $user->getPassword())
                return $user;
            else
                return false;
        }
        else
            return false;
    }

    public function findArray()
    {
        $users = $this->findAll();
        $a = array();
        foreach($users as $user)
        {
            $a[$user->getId()]['id'] = $user->getId();
            $a[$user->getId()]['nome'] = $user->getNome();
            $a[$user->getId()]['email'] = $user->getEmail();
        }

        return $a;
    }

    private function findRoleById($id)
    {
        $role = $this->_em->getRepository('SONAcl\Entity\Role')->findById($id);
        return $role[0];
    }
}
