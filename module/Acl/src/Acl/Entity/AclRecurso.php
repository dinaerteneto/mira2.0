<?php

namespace Acl\Entity;

use Vivo\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * AclRecurso
 *
 * @ORM\Table(name="acl_recurso")
 * @ORM\Entity
 */
class AclRecurso extends AbstractEntity
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
     * @var \DateTime
     *
     * @ORM\Column(name="criado_em", type="datetime", nullable=false)
     */
    private $criadoEm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alterado_em", type="datetime", nullable=false)
     */
    private $alteradoEm;

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

    public function getCriadoEm() {
        return $this->criadoEm;
    }

    public function getAlteradoEm() {
        return $this->alteradoEm;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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

    public function getArrayCopy() {
        return get_object_vars($this);
    }     
    
}

