<?php
namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SONAcl\Entity\Dropdown;
use Zend\Navigation\Navigation;
use SONAcl\Entity\Navigator;

class LoadDropdown extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $role2 = $manager->getReference('SONAcl\Entity\Role',2);
        $role3 = $manager->getReference('SONAcl\Entity\Role',3);
        $role4 = $manager->getReference('SONAcl\Entity\Role',4);
        $role5 = $manager->getReference('SONAcl\Entity\Role',5);

        $dropDown1 = $manager->getReference('SONAcl\Entity\DropDown',1);
        $dropDown2 = $manager->getReference('SONAcl\Entity\DropDown',2);
        $dropDown3 = $manager->getReference('SONAcl\Entity\DropDown',3);

        $navigator = new Navigator();
        $navigator->setId(1);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown1);
        $navigator->setRole($role4);
        $manager->persist($navigator);

        $navigator = new Navigator();
        $navigator->setId(2);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown2);
        $navigator->setRole($role4);
        $manager->persist($navigator);

        $navigator = new Navigator();
        $navigator->setId(3);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown2);
        $navigator->setRole($role2);
        $manager->persist($navigator);

        $navigator = new Navigator();
        $navigator->setId(4);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown2);
        $navigator->setRole($role3);
        $manager->persist($navigator);

        $navigator = new Navigator();
        $navigator->setId(5);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown1);
        $navigator->setRole($role5);
        $manager->persist($navigator);

        $navigator = new Navigator();
        $navigator->setId(6);
        $navigator->setCreatedAt(new \Datetime("now"));
        $navigator->setUpdatedAt(new \Datetime("now"));
        $navigator->setDropdown($dropDown3);
        $navigator->setRole($role4);
        $manager->persist($navigator);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}