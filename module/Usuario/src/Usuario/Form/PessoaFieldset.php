<?php

namespace Usuario\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PessoaFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('pessoa');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new \Usuario\Entity\Usuario(array()));
        
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
        
    }
    
    
    public function getInputFilterSpecification() {
        return array(
            'id' => array(
                'required' => false
            ),
            'nome' => array(
                'required' => true
            ),           
            'cpf' => array(
                'required' => true
            )
        );
    }
} 
