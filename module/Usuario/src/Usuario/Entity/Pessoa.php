<?php

namespace Usuario\Entity;

use Vivo\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa", uniqueConstraints={@ORM\UniqueConstraint(name="cpf", columns={"cpf"})})
 * @ORM\Entity
 */
class Pessoa extends AbstractEntity {

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
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=15, nullable=false)
     */
    private $cpf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adicionado_em", type="datetime", nullable=false)
     */
    private $adicionadoEm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alterado_em", type="datetime", nullable=false)
     */
    private $alteradoEm;
    
    
    public function __construct(array $options = null) {
        //(new Hydrator\ClassMethods())->hydrate($options, $this);

        $this->adicionadoEm = new \DateTime("now");
        $this->alteradoEm = new \DateTime("now");
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento->format('Y-m-d');
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getAdicionadoEm() {
        return $this->adicionadoEm;
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

    public function setDataNascimento(\DateTime $dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setAdicionadoEm() {
        $this->adicionadoEm = new \DateTime("now");
    }

    /**
     * @ORM\prePersist
     */    
    public function setAlteradoEm() {
        $this->alteradoEm = new \DateTime("now");
    }

}
