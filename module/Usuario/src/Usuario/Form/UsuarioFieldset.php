<?php

namespace Usuario\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class UsuarioFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('usuario');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new \Usuario\Entity\Usuario());

        $login = new \Zend\Form\Element\Text('login');
        $login->setAttribute('placeholder', 'Login');
        $this->add($login);

        $email = new \Zend\Form\Element\Email('email');
        $email->setAttribute('placeholder', 'E-Mail');
        $this->add($email);

        $senha = new \Zend\Form\Element\Password('senha');
        $senha->setAttribute('placeholder', 'Senha');
        $this->add($senha);

        $senhaConfirmacao = new \Zend\Form\Element\Password('senha_confirmacao');
        $senhaConfirmacao->setAttribute('placeholder', 'Confirme a senha');
        $this->add($senhaConfirmacao);
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
