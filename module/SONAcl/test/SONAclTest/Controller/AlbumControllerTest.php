<?php

namespace SONAclTest\Controller;

use SONAclTest\TestCase;
use SONAcl\Service\Resource;

class AlbumControllerTest extends TestCase
{

    public function testAddActionCanBeAccessed()
    {
        $this->assertEquals(200,200);
    }

    public function testInsert() {
        $resource = new Resource($this->getEmMock());
        $data = array ('nome' => "Test MOCK");
        $result = $resource->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Resource', $result);

    }

    private function getEmMock() {
        $emMock = $this->getMock('\Doctrine\ORM\EntityManager',
                                 array('persist','flush'),array(),'', false);

        $emMock->expects($this->any())->method('persist')->will($this->returnValue(null));
        $emMock->expects($this->any())->method('flush')->will($this->returnValue(null));
        return $emMock;
    }
}