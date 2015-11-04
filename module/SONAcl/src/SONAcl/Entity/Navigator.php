<?php
namespace SONAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="sonacl_navigator")
 * @ORM\Entity(repositoryClass="SONAcl\Entity\NavigatorRepository")
 */
class Navigator
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SONAcl\Entity\Dropdown", inversedBy="navigator")
     * @ORM\JoinColumn(name="dropdown_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $dropdown;

    /**
     * @ORM\ManyToOne(targetEntity="SONAcl\Entity\Role", inversedBy="navigator")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $role;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDropdown()
    {
        return $this->dropdown;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDropdown($dropdown)
    {
        $this->dropdown = $dropdown;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}