<?php
namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;


/**
 * SonuserUsers
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\ComentarioRepository")
 */
class Comentario
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
     * @ORM\JoinColumn(name="id_materia", referencedColumnName="id")
     */
    private $idMateria;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $autor;

    /**
     *
     * @var string @ORM\Column(name="conteudo", type="text", nullable=false)
     */
    private $comentario;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdMateria()
    {
        return $this->idMateria;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getComentario()
    {
        return $this->comentario;
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

    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function __toString() {
        return $this->titulo;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}