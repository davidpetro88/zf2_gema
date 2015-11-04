<?php
namespace SONAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="sonacl_dropdownmenu")
 * @ORM\Entity(repositoryClass="SONAcl\Entity\DropdownmenuRepository")
 */
class Dropdownmenu
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SONAcl\Entity\Dropdown", inversedBy="dropdownmenu")
     * @ORM\JoinColumn(name="dropdown_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $dropdown;

    /**
     * @ORM\ManyToOne(targetEntity="SONAcl\Entity\Menu", inversedBy="navigator")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id" )
     */
    protected $menu;

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

    public function getMenu()
    {
        return $this->menu;
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

    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt()
    {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}