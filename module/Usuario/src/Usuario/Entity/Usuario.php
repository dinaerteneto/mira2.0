<?php

namespace Usuario\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="login", columns={"login"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="chave_ativacao", type="string", length=255, nullable=false)
     */
    private $chaveAtivacao;

    /**
     * @var \Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;
    
    /*
    public function __construct(array $options) {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
    } */   
    
    public function getLogin() {
        return $this->login;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getChaveAtivacao() {
        return $this->chaveAtivacao;
    }

    public function getId() {
        return $this->id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setChaveAtivacao($chaveAtivacao) {
        $this->chaveAtivacao = $chaveAtivacao;
    }

    public function setId(\Usuario\Entity\Pessoa $id) {
        $this->id = $id;
    }


}

