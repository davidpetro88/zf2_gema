<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SONUser\Entity\Status;

class LoadStatusMateria  extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {
/*
   insert into status_materias values (1, null, null, "PROPOSTA", sysdate(), sysdate());
   insert into status_materias values (2, null, null, "EM REVISÃO", sysdate(), sysdate());
   insert into status_materias values (3, null, null, "APROVADA", sysdate(), sysdate());
   insert into status_materias values (4, null, null, "PUBLICADA", sysdate(), sysdate());
   insert into status_materias values (5, null, null, "ARQUIVADA", sysdate(), sysdate());
 */

//     $status = new Status();
//     $status->setNome("PROPOSTA");

//         $registrado = $manager->getReference('SONAcl\Entity\Role',2);
//         $user = new User();
//         $user->setNome("David")
//              ->setEmail("teste@gmail.com")
//              ->setPassword(123456)
//              ->setActive(true)
//              ->setRole($registrado);
//         $manager->persist($user);

//         $registrado = $manager->getReference('SONAcl\Entity\Role',2);
//         $user = new User();
//         $user->setNome("Cevoscleu")
//              ->setEmail("teste@gmail.com")
//              ->setPassword(123456)
//              ->setActive(true)
//              ->setRole($registrado);
//         $manager->persist($user);


//         $admin = $manager->getReference('SONAcl\Entity\Role',4);
//         $user = new User();
//         $user->setNome("Admin")
//                 ->setEmail("david.abraao.petro@gmail.com")
//                 ->setPassword(123456)
//                 ->setActive(true)
//                 ->setRole($admin);
//         $manager->persist($user);

//         $manager->flush();
    }

    public function getOrder() {
        return 5;
    }
}