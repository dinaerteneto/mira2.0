<?php

namespace Acl\Entity;

use Vivo\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * AclPrivilegio
 *
 * @ORM\Table(name="acl_privilegio", indexes={@ORM\Index(name="fk_acl_privilegio_acl_papel", columns={"id_papel"}), @ORM\Index(name="fk_acl_privilegio_acl_recurso", columns={"id_acl_recurso"})})
 * @ORM\Entity
 */
class AclPrivilegio extends AbstractEntity {

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

    /**
     * @var \AclPapel
     *
     * @ORM\ManyToOne(targetEntity="AclPapel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_papel", referencedColumnName="id")
     * })
     */
    private $papel;

    /**
     * @var \AclRecurso
     *
     * @ORM\ManyToOne(targetEntity="AclRecurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acl_recurso", referencedColumnName="id")
     * })
     */
    private $recurso;

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

    public function getPapel() {
        return $this->papel;
    }

    public function getRecurso() {
        return $this->recurso;
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

    public function setAlteradoEm(\DateTime $alteradoEm) {
        $this->alteradoEm = $alteradoEm;
    }

    public function setPapel(AclPapel $idPapel) {
        $this->papel = $idPapel;
    }

    public function setRecurso(AclRecurso $idAclRecurso) {
        $this->recurso = $idAclRecurso;
    }

}
