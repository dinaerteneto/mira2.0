<?php

namespace Acl\Form;

use Zend\Form\Form;

class AclRecurso extends Form {

    public function __construct($name = null) {
        parent::__construct('acl-recurso');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'smart-form');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);        
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setAttribute('placeholder', 'Nome');
        $nome->setLabel('Nome');
        $nome->setLabelAttributes(array('class' => 'label'));
        $this->add($nome);
       
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
