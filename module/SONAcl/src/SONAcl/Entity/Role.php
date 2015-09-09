<?php

namespace SONAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection,
Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="sonacl_roles")
 * @ORM\Entity(repositoryClass="SONAcl\Entity\RoleRepository")
 */

class Role
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="SONAcl\Entity\Role")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="boolean", name="is_admin")
     * @var boolean
     */
    protected $isAdmin;

    /**
	 * @ORM\OneToMany(targetEntity="SONAcl\Entity\Navigator", mappedBy="role")
	 */
    protected $navigator;

    /**
     * @ORM\OneToMany(targetEntity="SONUser\Entity\User", mappedBy="role")
     */
    protected $users;

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

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
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


    /**
     * @return the $navigator
     */
    public function getNavigator()
    {
        return $this->navigator;
    }

 /**
     * @param field_type $navigator
     */
    public function setNavigator($navigator)
    {
        $this->navigator = $navigator;
    }

 public function __toString() {
        return $this->nome;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

//     public function toArray()
//     {
//         if(isset($this->parent))
//             $parent = $this->parent->getId();
//         else
//             $parent = false;

//         return array(
//           'id' => $this->id,
//           'nome' => $this->nome,
//             'isAdmin' => $this->isAdmin,
//             'parent' => $parent
//         );
//     }

}
