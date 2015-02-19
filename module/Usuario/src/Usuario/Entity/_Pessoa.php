<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa")
 * @ORM\Entity
 */
class Pessoa {

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
     * @ORM\Column(name="data_nascimento", type="date", nullable=false)
     */
    private $dataNascimento;
    
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="cpf", type="string", length=15 nullable=false) 
     */    
    private $cpf;
    
    /**
     *
     * @var \DateTime
     * 
     * @ORM\Column(name="alterado_em", type="date", nullable=false)
     */
    private $alteradoEm;

    /**
     * @var \DateTime 
     * 
     * @ORM\Column(name="adicionado_em", type="date", nullable=false)
     */
    private $adicionadoEm;

    public function __construct(array $options) {
        (new Hydrator\ClassMethods())->hydrate($options, $this);

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
        return $this->dataNascimento;
    }
    
    public function getAlteradoEm() {
        return $this->alteradoEm;
    }
    
    public function getCpf() {
        return $this->cpf;
    }
    
    public function getAdicionadoEm() {
        return $this->adicionadoEm;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    
    public function setDataNascimento(\DateTime $dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function setCriadoEm() {
        $this->adicionadoEm = new \DateTime("now");
    }
    
    /**
     * @ORM\prePersist
     */
    public function setAlteradoEm() {
        $this->alteradoEm = new \DateTime("now");
    }

}
