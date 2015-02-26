<?php

namespace Usuario\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {
    
    public function findByLoginAndSenha($login, $senha) {
        $usuario = $this->findOneByLogin($login);
        if($usuario) {
            $hashSenha = $usuario->encryptPassword($senha);
            if($hashSenha == $usuario->getSenha()) {
                return $usuario;
            }
        }
        return false;
    }
    
}

