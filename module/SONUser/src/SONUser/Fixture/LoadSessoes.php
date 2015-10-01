<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SONUser\Entity\Sessao;

class LoadSessoes  extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {

        $user1 = $manager->getReference('SONAcl\Entity\User',1);

        $sessoes = new Sessao();
        $sessoes->setId(1);
        $sessoes->setGerente($user1);
        $sessoes->setNome("Futebol");
        $sessoes->setCreatedAt(new \Datetime("now"));
        $sessoes->setUpdatedAt(new \Datetime("now"));
        $manager->persist($sessoes);

        $sessoes = new Sessao();
        $sessoes->setId(2);
        $sessoes->setGerente($user1);
        $sessoes->setNome("Informatica");
        $sessoes->setCreatedAt(new \Datetime("now"));
        $sessoes->setUpdatedAt(new \Datetime("now"));
        $manager->persist($sessoes);

        $sessoes = new Sessao();
        $sessoes->setId(3);
        $sessoes->setGerente($user1);
        $sessoes->setNome("Musica");
        $sessoes->setCreatedAt(new \Datetime("now"));
        $sessoes->setUpdatedAt(new \Datetime("now"));
        $manager->persist($sessoes);

        $sessoes = new Sessao();
        $sessoes->setId(4);
        $sessoes->setGerente($user1);
        $sessoes->setNome("Politica");
        $sessoes->setCreatedAt(new \Datetime("now"));
        $sessoes->setUpdatedAt(new \Datetime("now"));
        $manager->persist($sessoes);

        $sessoes = new Sessao();
        $sessoes->setId(5);
        $sessoes->setGerente($user1);
        $sessoes->setNome("Economia");
        $sessoes->setCreatedAt(new \Datetime("now"));
        $sessoes->setUpdatedAt(new \Datetime("now"));
        $manager->persist($sessoes);

        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }
}