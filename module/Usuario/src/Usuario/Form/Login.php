<?php

namespace Usuario\Form;

use Zend\Form\Form;

class Login extends Form {

    public function __construct() {
        parent::__construct('login');

        $this->setAttribute('method', 'post');

        $login = new \Zend\Form\Element\Text("login");
        $login->setLabel("Login / RE ")
            ->setAttribute('placeholder', 'Digite seu RE');
        $this->add($login);

        $senha = new \Zend\Form\Element\Password("senha");
        $senha->setLabel("Senha: ")
            ->setAttribute('placeholder', 'Digite sua senha');
        $this->add($senha);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Entrar',
                'class' => 'btn btn-primary'
            )
        ));
    }

}
