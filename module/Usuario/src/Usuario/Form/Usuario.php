<?php

namespace Usuario\Form;

use Zend\Form\Form;

class Usuario extends Form {

    public function __construct() {
        parent::__construct('usuario');
               
        $this->setAttribute('method', 'post');  
        $this->setAttribute('class', 'smart-form');
        $this->setInputFilter(new UsuarioFilter());

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);        
        
        //pessoa
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setAttribute('placeholder', 'Nome');
        $nome->setLabel('Nome');
        $nome->setLabelAttributes(array('class' => 'label'));
        $this->add($nome);
        
        $dataNascimento = new \Zend\Form\Element\Text('data_nascimento');
        $dataNascimento->setAttribute('placeholder', 'Data de Nasc.');
        $dataNascimento->setAttribute('class', 'mask-date-picker');
        $dataNascimento->setLabel('Data de Nasc.');
        $dataNascimento->setLabelAttributes(array('class' => 'label'));         
        $this->add($dataNascimento);

        $cpf = new \Zend\Form\Element\Text('cpf');
        $cpf->setAttribute('placeholder', 'CPF');
        $cpf->setAttribute('class', 'mask-cpf');
        $cpf->setLabel('CPF');
        $cpf->setLabelAttributes(array('class' => 'label'));          
        $this->add($cpf);          
                
        $login = new \Zend\Form\Element\Text('login');
        $login->setAttribute('placeholder', 'Login');
        $login->setLabel('Login');
        $login->setLabelAttributes(array('class' => 'label'));        
        $this->add($login);

        $email = new \Zend\Form\Element\Email('email');
        $email->setAttribute('placeholder', 'E-Mail');
        $email->setLabel('E-mail');
        $email->setLabelAttributes(array('class' => 'label'));
        $this->add($email);

        $senha = new \Zend\Form\Element\Password('senha');
        $senha->setAttribute('placeholder', 'Senha');
        $senha->setLabel('Senha');
        $senha->setLabelAttributes(array('class' => 'label'));
        $this->add($senha);

        $senhaConfirmacao = new \Zend\Form\Element\Password('senha_confirmacao');
        $senhaConfirmacao->setAttribute('placeholder', 'Confirme a senha');
        $senhaConfirmacao->setLabel('Confirme a senha');
        $senhaConfirmacao->setLabelAttributes(array('class' => 'label'));
        $this->add($senhaConfirmacao);
        
        //segurança (csrf)
        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));
    }

}
