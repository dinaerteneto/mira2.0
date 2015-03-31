<?php

namespace Acl\Entity;

use Vivo\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * AclPapel
 *
 * @ORM\Table(name="acl_papel", indexes={@ORM\Index(name="fk_acl_papel_acl_papel", columns={"id_pai"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Acl\Entity\AclPapelRepository")
 */
class AclPapel extends AbstractEntity
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
     * @ORM\Column(name="nome", type="string", length=50, nullable=false)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="admin", type="bigint", nullable=true)
     */
    private $admin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="criado_em", type="datetime", nullable=true)
     */
    private $criadoEm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alterado_em", type="datetime", nullable=true)
     */
    private $alteradoEm;

    /**
     * @ORM\OneToOne(targetEntity="AclPapel")
     * @ORM\JoinColumn(name="id_pai", referencedColumnName="id")
     */
    private $pai;
    
    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods())->hydrate($options, $this);

        $this->criadoEm = new \DateTime("now");
        $this->alteradoEm = new \DateTime("now");
    }        

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getCriadoEm() {
        return $this->criadoEm;
    }

    public function getAlteradoEm() {
        return $this->alteradoEm;
    }

    public function getPai() {
        return $this->pai;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setCriadoEm(\DateTime $criadoEm) {
        $this->criadoEm = $criadoEm;
    }

    /**
     * @ORM\prePersist
     */    
    public function setAlteradoEm() {
        $this->alteradoEm = new \DateTime("now");
    }

    public function setPai($pai) {
        $this->pai = $pai;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }     

}

