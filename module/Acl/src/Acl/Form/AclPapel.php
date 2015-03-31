<?php

namespace Acl\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class AclPapel extends Form {

    public function __construct($pai) {
        parent::__construct('acl-papel');
        $this->pai = $pai;

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'smart-form');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);        
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setAttribute('placeholder', 'Nome');
        $nome->setLabel('Nome');
        $nome->setLabelAttributes(array('class' => 'label'));
        $this->add($nome);

        $todosPai = array_merge(array(0 => 'Selecione'), $this->pai);
        $pai = new Select();
        $pai->setLabel('Herda:')
            ->setName('pai')
            ->setOptions(array('value_options' => $todosPai));
        $this->add($pai);

        $isAdmin = new \Zend\Form\Element\Checkbox('admin');
        $isAdmin->setLabel('Admin?: ');
        $this->add($isAdmin);
        
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
