<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * SonuserUsers
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\MateriaRepository")
 */
class Materia
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
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="conteudo", type="text", nullable=false)
     */
    private $conteudo;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\Status",inversedBy="id")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     */
    private $autor;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="revisor_id", referencedColumnName="id")
     */
    private $revisor;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="publicador_id", referencedColumnName="id")
     */
    private $publicador;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\Sessao",inversedBy="id")
     * @ORM\JoinColumn(name="sessao_id", referencedColumnName="id")
     */
    private $sessao;

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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getSessao()
    {
        return $this->sessao;
    }

    public function setSessao($sessao)
    {
        $this->sessao = $sessao;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getRevisor()
    {
        return $this->revisor;
    }

    public function setRevisor($revisor)
    {
        $this->revisor = $revisor;
        return $this;
    }

    public function getPublicador()
    {
        return $this->publicador;
    }

    public function setPublicador($publicador)
    {
        $this->publicador = $publicador;
        return $this;
    }

    public function __toString() {
        return $this->titulo;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }


}