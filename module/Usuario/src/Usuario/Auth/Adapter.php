<?php

namespace Usuario\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

class Adapter implements AdapterInterface {
    
    protected $em;
    protected $login;
    protected $senha;
    
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function authenticate() {
        $repository = $this->em->getRepository('Usuario\Entity\Usuario');
        $usuario = $repository->findByLoginAndSenha($this->getLogin(), $this->getSenha());
        if($usuario) {
            return new Result(Result::SUCCESS, array('usuario' => $usuario), array('ok'));
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
    }

}