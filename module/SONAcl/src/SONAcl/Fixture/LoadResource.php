<?php

namespace SONAcl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use SONAcl\Entity\Resource;

class LoadResource extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $resource = new Resource;
        $resource->setNome("Posts");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Páginas");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Novo / Editar");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Excluir");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Application\\Controller\\Index\\index");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Auth\\logout");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Auth\\index");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Roles\index");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("roles\edit");
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("roles\\new");
        $manager->persist($resource);


        $resource = new Resource;
        $resource->setNome("users\\index");
        $manager->persist($resource);



        $manager->flush();

    }

    public function getOrder() {
        return 2;
    }
}
