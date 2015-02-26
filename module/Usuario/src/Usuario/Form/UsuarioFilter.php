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
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Login é obrigatório')))
            )
        ));

        //email
        $validator = new \Zend\Validator\EmailAddress;
        $validator->setOptions(array('domain' => false));

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'E-Mail é obrigatório'))),
                array('name' => 'EmailAddress', 'options' => array('domain' => false))
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
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'A senha é obrigatória')))
            )
        ));

        //confirmação de senha
        $this->add(array(
            'name' => 'senha_confirmacao',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'A confirmação de senha é obrigatória')),
                    'name' => 'Identical', 'options' => array('token' => 'senha')
                )
            )
        ));

        //nome
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Nome é obrigatório')))
            )
        ));

        //data_nascimento
        $this->add(array(
            'name' => 'data_nascimento',
            'required' => false,
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
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'CPF é obrigatório')))
            )
        ));
    }

}
