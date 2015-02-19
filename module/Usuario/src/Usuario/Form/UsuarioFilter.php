<?php

namespace Usuario\Form;

use Zend\InputFilter\InputFilter;

class UsuarioFilter extends InputFilter {

    public function __construct() {
        //login
        $this->add(array(
            'name' => 'login',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
            )
        ));
        
        //senha
        $this->add(array(
            'name' => 'senha',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
            )
        ));
        
        
    }

}
