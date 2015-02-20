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
        $hydrator = new DoctrineHydrator($this->em);
        
        //persiste a pessoa
        $pessoa = new \Usuario\Entity\Pessoa();
        $pessoa->setDataNascimento(\DateTime::createFromFormat('Y-m-d', $data['pessoa']['data_nascimento']));
        $pessoa = $hydrator->hydrate($data['pessoa'], $pessoa);
        $this->em->persist($pessoa);
        $this->em->flush();
        
        $usuario = $hydrator->hydrate($data, new \Usuario\Entity\Usuario());
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
        $entity = $this->em->getReference($this->entity, $data['id']);
        if (empty($data['password'])) {
            unset($data['password']);
        }
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
