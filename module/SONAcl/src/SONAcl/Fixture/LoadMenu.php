<?php
namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SONAcl\Entity\Menu;


class LoadMenu extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {

        $menu = new Menu();
        $menu->setId(1);
        $menu->setNome("Menu");
        $menu->setUrl("sonacl-admin-menu");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(2);
        $menu->setNome("Navigator");
        $menu->setUrl("sonacl-admin-navigator");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);


        $menu = new Menu();
        $menu->setId(3);
        $menu->setNome("Matéria");
        $menu->setUrl("sonuser-materia");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(4);
        $menu->setNome("Status Matéria");
        $menu->setUrl("sonuser-status-materia");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(5);
        $menu->setNome("Sessões Matéria");
        $menu->setUrl("sonuser-sessao");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(6);
        $menu->setNome("Matéria Capa");
        $menu->setUrl("sonuser-capa-materia");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(7);
        $menu->setNome("Privileges");
        $menu->setUrl("sonacl-admin-privilege");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(8);
        $menu->setNome("Resources");
        $menu->setUrl("sonacl-admin-resource");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(9);
        $menu->setNome("Role");
        $menu->setUrl("sonacl-admin");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(10);
        $menu->setNome("DropDown");
        $menu->setUrl("sonacl-admin-dropdown");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $menu = new Menu();
        $menu->setId(11);
        $menu->setNome("DropDown Menu");
        $menu->setUrl("sonacl-admin-dropdownmenu");
        $menu->setCreatedAt(new \Datetime("now"));
        $manager->persist($menu);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}