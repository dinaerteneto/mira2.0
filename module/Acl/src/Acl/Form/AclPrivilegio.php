<?php

namespace Acl\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class AclPrivilegio extends Form {

    public function __construct($name = null, array $papel, array $recurso) {

        parent::__construct($name);
        $this->papel = $papel;
        $this->recurso = $recurso;

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
            ->setAttribute('placeholder', "Entre com o nome");
        $this->add($nome);

        $role = new Select();
        $role->setLabel("Papel: ")
            ->setName("papel")
            ->setOptions(array('value_options' => $papel));
        $this->add($role);

        $resource = new Select();
        $resource->setLabel("Recurso: ")
            ->setName("recurso")
            ->setOptions(array('value_options' => $recurso));
        $this->add($resource);

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
