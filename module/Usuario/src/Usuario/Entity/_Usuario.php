<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2,
    Zend\Stdlib\Hydrator;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Usuario\Entity\UsuarioRepository")
 */
class Usuario {

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
     * @var int
     *
     * @ORM\Column(name="status", type="int", nullable=true)
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

    public function __construct(array $options) {

        (new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->chaveAtivacao = md5($this->email . $this->salt);
    }

    public function getLogin() {
        return $this->login;
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

    public function getId() {
        return $this->id;
    }

    public function getChaveAtivacao() {
        return $this->chaveAtivacao;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function encryptPassword($password) {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password * 2)));
    }

    public function setSenha($senha) {
        $this->senha = $this->encryptPassword($senha);
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setId(\Pessoa $id) {
        $this->id = $id;
    }

    public function setChaveAtivacao($chaveAtivacao) {
        $this->chaveAtivacao = $chaveAtivacao;
    }

}
