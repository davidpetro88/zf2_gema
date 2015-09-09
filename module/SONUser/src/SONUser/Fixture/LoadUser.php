<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


use SONUser\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {


        $registrado = $manager->getReference('SONAcl\Entity\Role',2);
        $user = new User();
        $user->setNome("David")
             ->setEmail("teste@gmail.com")
             ->setPassword(123456)
             ->setActive(true)
             ->setRole($registrado);
        $manager->persist($user);

        $registrado = $manager->getReference('SONAcl\Entity\Role',2);
        $user = new User();
        $user->setNome("Cevoscleu")
             ->setEmail("teste@gmail.com")
             ->setPassword(123456)
             ->setActive(true)
             ->setRole($registrado);
        $manager->persist($user);


        $admin = $manager->getReference('SONAcl\Entity\Role',4);
        $user = new User();
        $user->setNome("Admin")
                ->setEmail("david.abraao.petro@gmail.com")
                ->setPassword(123456)
                ->setActive(true)
                ->setRole($admin);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }
}
