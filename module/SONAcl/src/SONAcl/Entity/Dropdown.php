<?php

namespace SONAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="sonacl_dropdown")
 * @ORM\Entity(repositoryClass="SONAcl\Entity\DropdownRepository")
 */
class Dropdown
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     * @var string
     */
    protected $nome;


    /**
	 * @ORM\OneToMany(targetEntity="SONAcl\Entity\Dropdownmenu", mappedBy="role")
	 */
    protected $dropdownmenu;


    /**
     * @ORM\OneToMany(targetEntity="SONAcl\Entity\Navigator", mappedBy="dropdownmenu")
     */
    protected $navigator;


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
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDropdownmenu()
    {
        return $this->dropdownmenu;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDropdownmenu($dropdownmenu)
    {
        $this->dropdownmenu = $dropdownmenu;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function getNavigator()
    {
        return $this->navigator;
    }

 public function setNavigator($navigator)
    {
        $this->navigator = $navigator;
    }

 public function toArray()
    {
        return (new Hydrator\ClassMethods)->extract($this);
    }

}
