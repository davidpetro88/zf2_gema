<?php

namespace SONAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="sonacl_menu")
 * @ORM\Entity(repositoryClass="SONAcl\Entity\MenuRepository")
 */

class Menu
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
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     * @var string
     */
    protected $url;

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

    public function getUrl()
    {
        return $this->url;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

 /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

 /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

 /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

 /**
     * @param Ambigous <\DateTime, \Datetime> $createdAt
     */
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

    public function toArray()
    {
        return (new Hydrator\ClassMethods)->extract($this);
    }
}
