<?php

namespace Usuario\Form;

use Zend\InputFilter\InputFilter;

class PessoaFilter extends InputFilter {

    public function __construct() {
        //login
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
            )
        ));
        
        //data_nascimento
        $this->add(array(
            'name' => 'data_nascimento',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        
        //cpf
        $this->add(array(
            'name' => 'cpf',
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
