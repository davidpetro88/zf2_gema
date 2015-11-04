<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * SonuserUsers
 *
 * @ORM\Table(name="sessoes")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\SessaoRepository")
 */
class Sessao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="gerente_id", referencedColumnName="id")
     */
    private $gerente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options,$this);
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

    public function getGerente()
    {
        return $this->gerente;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
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

    public function setGerente($gerente)
    {
        $this->gerente = $gerente;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt($updatedAt)
    {
       $this->updatedAt = new \DateTime("now");
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime("now");
    }

    public function __toString() {
        return $this->nome;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}