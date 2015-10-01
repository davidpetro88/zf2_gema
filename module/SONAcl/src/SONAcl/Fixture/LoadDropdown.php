<?php
namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SONAcl\Entity\Dropdown;

class LoadDropdown extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $dropDown = new Dropdown();
        $dropDown->setId(1);
        $dropDown->setNome("Administração");
        $dropDown->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropDown);

        $dropDown = new Dropdown();
        $dropDown->setId(2);
        $dropDown->setNome("Matéria");
        $dropDown->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropDown);

        $dropDown = new Dropdown();
        $dropDown->setId(3);
        $dropDown->setNome("Usuário");
        $dropDown->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropDown);

        $manager->flush();
    }


    public function getOrder()
    {
        return 5;
    }
}