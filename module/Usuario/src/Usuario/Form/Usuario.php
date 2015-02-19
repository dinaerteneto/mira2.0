<?php

namespace Usuario\Form;

use Zend\Form\Form;

class Usuario extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('usuario', $options);
        $this->setInputFilter(new UsuarioFilter());
        $this->setAttributes('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $login = new \Zend\Form\Element\Text('login');
        $login->setAttribute('placeholder', 'Login');
        $this->add($login);

        $email = new \Zend\Form\Element\Email('email');
        $email->setAttribute('placeholder', 'E-Mail');
        $this->add($email);      
        
        $senha = new \Zend\Form\Element\Password('senha');
        $senha->setAttribute('placeholder', 'Senha');
        $this->add($senha);
        
        $senhaConfirmacao = new \Zend\Form\Element\Password('senha_confirmacao');
        $senhaConfirmacao->setAttribute('placeholder', 'Confirme a senha');
        $this->add($senhaConfirmacao);
        
        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

}
