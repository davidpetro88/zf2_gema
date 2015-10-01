<?php
namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SONAcl\Entity\Dropdownmenu;

class LoadDropdownmenu extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $dropDown1 = $manager->getReference('SONAcl\Entity\DropDown',1);
        $menu1 = $manager->getReference('SONAcl\Entity\Menu',1);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(1);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu1);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $dropDown2 = $manager->getReference('SONAcl\Entity\DropDown',2);
        $menu3 = $manager->getReference('SONAcl\Entity\Menu',3);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(2);
        $dropdownmenu->setDropdown($dropDown2);
        $dropdownmenu->setMenu($menu3);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu4 = $manager->getReference('SONAcl\Entity\Menu',4);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(3);
        $dropdownmenu->setDropdown($dropDown2);
        $dropdownmenu->setMenu($menu4);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu6 = $manager->getReference('SONAcl\Entity\Menu',6);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(4);
        $dropdownmenu->setDropdown($dropDown2);
        $dropdownmenu->setMenu($menu6);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu2 = $manager->getReference('SONAcl\Entity\Menu',2);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(5);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu2);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu7 = $manager->getReference('SONAcl\Entity\Menu',7);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(6);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu7);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu8 = $manager->getReference('SONAcl\Entity\Menu',8);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(7);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu8);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu9 = $manager->getReference('SONAcl\Entity\Menu',9);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(8);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu9);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu10 = $manager->getReference('SONAcl\Entity\Menu',10);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(9);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu10);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $menu11 = $manager->getReference('SONAcl\Entity\Menu',11);
        $dropdownmenu = new Dropdownmenu();
        $dropdownmenu->setId(10);
        $dropdownmenu->setDropdown($dropDown1);
        $dropdownmenu->setMenu($menu11);
        $dropdownmenu->setCreatedAt(new \Datetime("now"));
        $manager->persist($dropdownmenu);

        $manager->flush();
    }


    public function getOrder()
    {
        return 6;
    }

}