<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SONUser\Entity\Status;

class LoadStatusMateria  extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {

        $status = new Status();
        $status->setId(1);
        $status->setNome("PROPOSTA");
        $status->setCreatedAt(new \Datetime("now"));
        $status->setUpdatedAt(new \Datetime("now"));
        $manager->persist($status);

        $status = new Status();
        $status->setId(2);
        $status->setNome("REVISADA");
        $status->setCreatedAt(new \Datetime("now"));
        $status->setUpdatedAt(new \Datetime("now"));
        $manager->persist($status);

        $status = new Status();
        $status->setId(3);
        $status->setNome("APROVADA");
        $status->setCreatedAt(new \Datetime("now"));
        $status->setUpdatedAt(new \Datetime("now"));
        $manager->persist($status);

        $status = new Status();
        $status->setId(4);
        $status->setNome("PUBLICADA");
        $status->setCreatedAt(new \Datetime("now"));
        $status->setUpdatedAt(new \Datetime("now"));
        $manager->persist($status);

        $status = new Status();
        $status->setId(5);
        $status->setNome("ARQUIVADA");
        $status->setCreatedAt(new \Datetime("now"));
        $status->setUpdatedAt(new \Datetime("now"));
        $manager->persist($status);

        $menu->setId(1);
        $menu->setNome("Menu");
        $menu->setUrl("sonacl-admin-menu");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }
}