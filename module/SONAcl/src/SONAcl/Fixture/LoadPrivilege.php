<?php

namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use SONAcl\Entity\Privilege;

class LoadPrivilege extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $role1 = $manager->getReference('SONAcl\Entity\Role',1);
        $resource1 = $manager->getReference('SONAcl\Entity\Resource',1);

        $role2 = $manager->getReference('SONAcl\Entity\Role',2);
        $resource2 = $manager->getReference('SONAcl\Entity\Resource',2);

        $role3 = $manager->getReference('SONAcl\Entity\Role',3);
        $resource3 = $manager->getReference('SONAcl\Entity\Resource',3);

        $role4 = $manager->getReference('SONAcl\Entity\Role',4);
        $resource4 = $manager->getReference('SONAcl\Entity\Resource',4);

        $role5 = $manager->getReference('SONAcl\Entity\Role',1);
        $resource5 = $manager->getReference('SONAcl\Entity\Resource',5);

        $role6 = $manager->getReference('SONAcl\Entity\Role',1);
        $resource6 = $manager->getReference('SONAcl\Entity\Resource',6);

        $role7 = $manager->getReference('SONAcl\Entity\Role',1);
        $resource7 = $manager->getReference('SONAcl\Entity\Resource',7);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                ->setRole($role1)
                ->setResource($resource1);
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                   ->setRole($role2)
                   ->setResource($resource2);
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Novo / Editar")
                ->setRole($role3)
                ->setResource($resource3);
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Excluir")
                ->setRole($role4)
                ->setResource($resource4);
        $manager->persist($privilege);


        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                  ->setRole($role5)
                  ->setResource($resource5);
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                    ->setRole($role6)
                    ->setResource($resource6);
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                   ->setRole($role7)
                   ->setResource($resource7);
        $manager->persist($privilege);

        $manager->flush();

    }

    public function getOrder() {
        return 3;
    }
}
