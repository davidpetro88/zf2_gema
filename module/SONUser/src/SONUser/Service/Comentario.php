<?php
namespace SONUser\Service;

use SONBase\Service\AbstractService;

class Comentario extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'SONUser\Entity\Comentario';
    }

    /* @var $entity \SONUser\Entity\Comentario */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setAutor($this->em->getReference('SONUser\Entity\User', $data['codigoCliente']));
        $entity->setIdMateria($this->em->getReference('SONUser\Entity\Materia', $data['idMateria']));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}