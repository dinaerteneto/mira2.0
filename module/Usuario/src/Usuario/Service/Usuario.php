<?php

namespace Usuario\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Usuario extends AbstractService {

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view) {
        parent::__construct($em);
        $this->entity = 'Usuario\Entity\Usuario';
        $this->transport = $transport;
        $this->view = $view;
    }

    /**
     * Persiste o usuário
     * entretanto, para persistir o usuário são necessários os passos:
     * 1. Incluir uma pessoa
     * 2. Incluir um usuário atrelado a esta pessoa
     * 3. Criar um grupo especifico para este usuário
     * 4. Atrelar o usuário a este novo grupo
     * @param array $data
     * @return Usuario\Entity\Pessoa
     */
    public function insert(array $data) {
        unset($data['id']);
        $data['data_nascimento'] = \DateTime::createFromFormat('Y-m-d', $data['data_nascimento']);

        //persiste a pessoa
        $pessoa = new \Usuario\Entity\Pessoa($data);
        $this->em->persist($pessoa);
        $this->em->flush();

        //persiste o usuário
        $usuario = new \Usuario\Entity\Usuario($data);
        $usuario->setId($pessoa);
        $this->em->persist($usuario);
        $this->em->flush();

        //persiste o grupo do usuário
        $usuarioGrupo = new \Usuario\Entity\UsuarioGrupo();
        $usuarioGrupo->setNome($pessoa->getNome());
        $usuarioGrupo->setTipo('OWG');
        $this->em->persist($usuarioGrupo);
        $this->em->flush();

        //faz o agrupamento do usuário
        $usuarioAgrupamento = new \Usuario\Entity\UsuarioAgrupamento();
        $usuarioAgrupamento->setIdUsuario($usuario);
        $usuarioAgrupamento->setIdUsuarioGrupo($usuarioGrupo);
        $this->em->persist($usuarioAgrupamento);
        $this->em->flush();

        return $usuario;
    }

    public function activate($key) {
        $repository = $this->em->getRepository("Usuario\Entity\Usuario");
        $usuario = $repository->findOneByChaveAtivacao($key);
        if ($usuario && !$usuario->getStatus()) {
            $usuario->setStatus(1);
            $this->em->persist($usuario);
            $this->em->flush();

            return $usuario;
        }
    }

    public function update(array $data) {
        $key = $data['id'];
        unset($data['id']);
      
        $data['data_nascimento'] = \DateTime::createFromFormat('Y-m-d', $data['data_nascimento']);
        
        $pessoa = $this->em->getReference('Usuario\Entity\Pessoa', $key);
        (new Hydrator\ClassMethods())->hydrate($data, $pessoa);
        $this->em->persist($pessoa);
        $this->em->flush();        
        
        $usuario = $this->em->getReference('Usuario\Entity\Usuario', $key);
        if (empty($data['senha'])) {
            unset($data['senha']);
            unset($data['senha_confirmacao']);
        }          
        (new Hydrator\ClassMethods())->hydrate($data, $usuario);
        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }

}
