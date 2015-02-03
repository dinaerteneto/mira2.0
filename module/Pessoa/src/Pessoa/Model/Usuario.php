<?php

namespace Pessoa\Model;

use Doctrine\ORM\Mapping as ORM;
use Vivo\Entity\AbstractEntity;
use Vivo\InputFilter\InputFilter;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario.usuario")
 */
class Usuario extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Pessoa") 
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $login;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $senha;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salt;

    /**
     * @ORM\Column(type="boolean")
     * @var string
     */
    protected $ativo;

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Pessoa")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     * @var type 
     */
    protected $pessoa;

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getPessoa() {
        return $this->pessoa;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }    
    
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('login', new StripTags());
            $inputFilter->addFilter('login', new StringTrim());
            $inputFilter->addValidator('login', new StringLength(array(
                'enconding' => 'UTF-8',
                'min' => 2,
                'max' => 30
                )
                )
            );
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
