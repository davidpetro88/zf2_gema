<?php
namespace SONAclTest\Service;


use SONAclTest\TestCase;
use SONAcl\Service\Role;

class RoleTest extends TestCase {

    public function testInsertRoleSemParent() {
        $class = new Role($this->getEmMock());
        $data = array ('nome' => "MOCK Role", 'parent' => null);
        $result = $class->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Role', $result);
    }

    public function testInsertRoleComParent() {
        $class = new Role($this->getEmMock());
        $data = array ('nome' => "MOCK Role", 'parent' => 1);
        $result = $class->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Role', $result);
    }

    public function testUpdateRoleSemParent()
    {
        $class = new Role($this->getEmMock());
        $data = array ('nome' => "MOCK Role", 'id' => 12, 'parent' => null);
        $result = $class->update($data);
        $this->assertEquals(12, $result->getId());
        $this->assertEquals('MOCK Role', $result->getNome());
    }

    public function testUpdateRoleComParent()
    {
        $class = new Role($this->getEmMock());
        $data = array ('nome' => "MOCK Role", 'id' => 12, 'parent' => 1);
        $result = $class->update($data);
        $this->assertEquals(12, $result->getId());
        $this->assertEquals('MOCK Role', $result->getNome());
    }

    public function testDeleteRole() {
        $class = new Role($this->getEmMock());
        $this->assertEquals(12, $class->delete(12));
    }

    private function getEmMock() {
        $emMock = $this->getMock('\Doctrine\ORM\EntityManager', array('getReference', 'remove', 'persist', 'flush')
            , array()
            , ''
            , false);
        $emMock->expects($this->any()) ->method('getReference') ->will($this->returnValue($this->getRole ()));
        $emMock->expects($this->any()) ->method('remove') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('persist') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('flush') ->will($this->returnValue(null));
        return $emMock;
    }

    private function getRole () {
        $resource = new \SONAcl\Entity\Role();
        $resource->setId(1);
        $resource->setNome("MOCK Role");
        return $resource;
    }
}