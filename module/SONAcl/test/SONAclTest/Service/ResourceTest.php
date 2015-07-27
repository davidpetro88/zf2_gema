<?php
namespace SONAclTest\Service;

use SONAclTest\TestCase;
use SONAcl\Service\Resource;

class ResourceTest extends TestCase {

    public function testInsertResource() {
        $class = new Resource($this->getEmMock());
        $data = array ('nome' => "Test MOCK");
        $result = $class->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Resource', $result);
    }

    public function testUpdateResource()
    {
        $class = new Resource($this->getEmMock());
        $data = array ('nome' => "Test MOCK", 'id' => 12);
        $result = $class->update($data);
        $this->assertEquals(12, $result->getId());
        $this->assertEquals('Test MOCK', $result->getNome());
    }

    public function testRemveResource() {
        $class = new Resource($this->getEmMock());
        $this->assertEquals(12, $class->delete(12));
    }

    private function getEmMock() {
        $emMock = $this->getMock('\Doctrine\ORM\EntityManager', array('getReference', 'remove', 'persist', 'flush')
                                                              , array()
                                                              , ''
                                                              , false);
        $emMock->expects($this->any()) ->method('getReference') ->will($this->returnValue($this->getResourceUpdate ()));
        $emMock->expects($this->any()) ->method('remove') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('persist') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('flush') ->will($this->returnValue(null));
        return $emMock;
    }

    private function getResourceUpdate () {
        $resource = new \SONAcl\Entity\Resource();
        $resource->setId(12);
        $resource->setNome("MOCK getResourceUpdate");
        return $resource;
    }
}
