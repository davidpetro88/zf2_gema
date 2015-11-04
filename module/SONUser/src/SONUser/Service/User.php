<?php

namespace SONUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use SONBase\Mail\Mail;

class User extends AbstractService
{
    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        parent::__construct($em);

        $this->entity = 'SONUser\Entity\User';
        $this->transport = $transport;
        $this->view = $view;
    }

    /* @var $entity \SONUser\Entity\User */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $entity->setRole($this->em->getReference('SONAcl\Entity\Role',$data["role"]));
        $this->em->persist($entity);
        $this->em->flush();

        $dataEmail = array('nome'=>$data['nome'],'activationKey'=>$entity->getActivationKey());

        if($entity)
        {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject('Confirmação de cadastro')
                 ->setTo($data['email'])
                 ->setData($dataEmail)
                 ->prepare()
                 ->send();
            return $entity;
        }
    }

    /* @var $user \SONUser\Entity\User */
    public function activate($key)
    {
        $repo = $this->em->getRepository('SONUser\Entity\User');
        $user = $repo->findOneByActivationKey($key);

        if($user && !$user->getActive())
        {
            $user->setActive(true);
            $this->em->persist($user);
            $this->em->flush();
            return $user;
        }
    }

    /* @var $entity \SONUser\Entity\User */
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        if(empty($data['password']))
            unset($data['password']);

        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $entity->setRole($this->em->getReference('SONAcl\Entity\Role',$data["role"]));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}