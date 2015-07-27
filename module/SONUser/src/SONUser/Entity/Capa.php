<?php
namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;


/**
 * SonuserUsers
 *
 * @ORM\Table(name="capa")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\CapaRepository")
 */
class Capa
{

    /**
     *
     * @var integer
     *
     *  @ORM\Column(name="id", type="integer", nullable=false)
     *  @ORM\Id
     *  @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\Materia",inversedBy="id")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */
    private $materia;

    /**
     * @var string
     *
     * @ORM\Column(name="capa", type="string", length=1, nullable=true)
     */
    private $capaPrincipal;

    /**
     * @var string
     *
     * @ORM\Column(name="ativo", type="string", length=1, nullable=true)
     */
    private $ativo;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="publicador_id", referencedColumnName="id")
     */
    private $usuario;

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

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $materia
     */
    public function getMateria()
    {
        return $this->materia;
    }

 /**
     * @return the $capaPrincipal
     */
    public function getCapaPrincipal()
    {
        return $this->capaPrincipal;
    }

 /**
     * @return the $usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

 /**
     * @return the $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

 /**
     * @return the $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

 /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

 /**
     * @param field_type $materia
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;
    }

 /**
     * @param string $capaPrincipal
     */
    public function setCapaPrincipal($capaPrincipal)
    {
        $this->capaPrincipal = $capaPrincipal;
    }

 /**
     * @param field_type $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

 /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

 /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
 /**
     * @return the $ativo
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

 /**
     * @param string $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}