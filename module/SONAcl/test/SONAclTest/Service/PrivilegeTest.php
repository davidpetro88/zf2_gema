<?php
namespace SONAclTest\Service;

use SONAclTest\TestCase;
use SONAcl\Service\Privilege;


class PrivilegeTest extends TestCase
{
    public function testInsertPrivilegeSemRoleAndResource() {
        $class = new Privilege($this->getEmMock());
        $data = array ('nome' => "MOCK Privilege", 'roles' => null, 'resources' => null );
        $result = $class->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Privilege', $result);
    }

    public function testInsertPrivilegeComRoleAndResource() {
        $class = new Privilege($this->getEmMock());
        $data = array ('nome' => "MOCK Privilege", 'roles' => 1, 'resources' => 1 );
        $result = $class->insert($data);
        $this->assertInstanceOf('SONAcl\Entity\Privilege', $result);
    }

    public function testUpdatePrivilege()
    {
        $class = new Privilege($this->getEmMock());
        $data = array ('id' => 1, 'nome' => "MOCK Privilege", 'roles' => null, 'resources' => null );
        $result = $class->update($data);
        $this->assertEquals(1, $result->getId());
        $this->assertEquals('MOCK Privilege', $result->getNome());
    }

    public function testDeletePrivilege() {
        $class = new Privilege($this->getEmMock());
        $this->assertEquals(12, $class->delete(12));
    }

    private function getEmMock() {
        $emMock = $this->getMock('\Doctrine\ORM\EntityManager', array('getReference', 'remove', 'persist', 'flush')
            , array()
            , ''
            , false);
        $emMock->expects($this->any()) ->method('getReference') ->will($this->returnValue($this->getPrivilege ()));
        $emMock->expects($this->any()) ->method('remove') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('persist') ->will($this->returnValue(null));
        $emMock->expects($this->any()) ->method('flush') ->will($this->returnValue(null));
        return $emMock;
    }

    private function getPrivilege () {
        $resource = new \SONAcl\Entity\Privilege();
        $resource->setId(1);
        $resource->setNome("MOCK Privilege");
        return $resource;
    }

    private function getClassMethodsHydrate () {
            return array( 'id' => $this->id, 'nome' => $this->nome, 'role' => $this->role->getId(), 'resource'=>$this->resource->getId());
    }
}