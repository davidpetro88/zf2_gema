<?php
namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * SonuserUsers
 *
 * @ORM\Table(name="status_materias")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\StatusRepository")
 */
class Status
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
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\Status",inversedBy="id")
     * @ORM\JoinColumn(name="next_status_id", referencedColumnName="id")
     */
    private $nextStatus;

    /**
     * @ORM\ManyToOne(targetEntity="SONUser\Entity\Status",inversedBy="id")
     * @ORM\JoinColumn(name="back_status_id", referencedColumnName="id")
     */
    private $backStatus;

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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
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

    public function getNextStatus()
    {
        return $this->nextStatus;
    }

    public function getBackStatus()
    {
        return $this->backStatus;
    }

    public function setNextStatus($nextStatus)
    {
        $this->nextStatus = $nextStatus;
    }

    public function setBackStatus($backStatus)
    {
        $this->backStatus = $backStatus;
    }

    public function __toString() {
        return $this->nome;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}