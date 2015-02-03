<?php

namespace Pessoa\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Vivo\Form\AbstractForm;

use Pessoa\Model\Usuario;

class PessoaForm extends AbstractForm {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('pessoa');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Usuario());
        
        $this->setAttribute('method', 'post');
        $this->addElement('nome', 'text', 'Nome');
        $this->addElement('re', 'text', 'RE');
        $this->addElement('data_nascimento', 'text', 'Data de Nasc.');
        $this->addElement('login', 'text', 'Login');
        $this->addElement('senha', 'password', 'Senha');
        $this->addElement('submit', 'submit', 'Gravar');        
    }

}
