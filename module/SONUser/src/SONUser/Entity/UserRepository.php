<?php

namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;

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

}
