<?php

namespace Usuario\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;

use Usuario\Entity\Pessoa,
    Usuario\Entity\Usuario,
    Usuario\Entity\UsuarioGrupo,
    Usuario\Entity\UsuarioAgrupamento;

class Usuario extends AbstractService {

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view) {
        parent::__contruct($em);
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
        $pessoa = new Pessoa($data);
        $this->em->persist($pessoa);
                
        $usuario = new Usuario($data);
        $this->em->persist($usuario);
        
        /*
        $usuarioGrupo = new UsuarioGrupo($dataUsuarioGrupo);
        $this->em->persist($usuarioGrupo);
        
        $usuarioAgrupamento = new UsuarioAgrupamento($dataUsuarioAgrupamento);
        $this->em->persist($usuarioAgrupamento);
        */
        
        $this->em->flush();
        
        return $pessoa;
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
