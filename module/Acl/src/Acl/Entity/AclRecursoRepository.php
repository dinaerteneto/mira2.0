<?php

namespace Acl\Entity;

use Doctrine\ORM\EntityRepository;

class AclRecursoRepository extends EntityRepository {

    public function fetchPairs() {
        $array = array();
        $entities = $this->findAll();
        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }

}
