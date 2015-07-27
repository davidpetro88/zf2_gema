<?php
namespace SONUser\Entity;

use Doctrine\ORM\EntityRepository;

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
            $a[$materia->getId()]['conteudo'] = $materia->getConteudo();
            $a[$materia->getId()]['status'] = $materia->getStatus();
            $a[$materia->getId()]['autor'] = $materia->getAutor();
            $a[$materia->getId()]['sessao'] = $materia->getSessao();
            $a[$materia->getId()]['updatedAt'] = $materia->getUpdatedAt();
            $a[$materia->getId()]['createdAt'] = $materia->getCreatedAt();
        }
        return $a;
    }
}