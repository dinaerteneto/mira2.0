<?php

namespace Usuario\Form;

use Zend\Form\Form;

class Pessoa extends Form {

    public function __construct($name = 'pessoa', $options = array()) {
        parent::__construct($name, $options);

        $this->setInputFilter(new PessoaFilter());
        $this->setAttribute('method', 'post');

        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setAttribute('placeholder', 'Nome');
        $this->add($nome);

        $dataNascimento = new \Zend\Form\Element\Text('data_nascimento');
        $dataNascimento->setAttribute('placeholder', 'Data de Nasc.');
        $dataNascimento->setAttribute('class', 'mask-date');
        $this->add($dataNascimento);

        $cpf = new \Zend\Form\Element\Text('cpf');
        $cpf->setAttribute('placeholder', 'CPF');
        $cpf->setAttribute('class', 'mask-cpf');
        $this->add($cpf);        
        
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
