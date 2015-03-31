<?php

namespace Acl\Service;

use Vivo\Service\AbstractService;

class AclPrivilegio extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\AclPrivilegio';
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);
        
        $papel = $this->em->getReference('Acl\Entity\AclPapel', $data['papel']);
        $entity->setPapel($papel);
        
        $recurso = $this->em->getReference('Acl\Entity\AclRecurso', $data['recurso']);
        $entity->setRecurso($recurso);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $papel = $this->em->getReference('Acl\Entity\AclPapel', $data['papel']);
        $entity->setPapel($papel);
        
        $recurso = $this->em->getReference('Acl\Entity\AclRecurso', $data['recurso']);
        $entity->setRecurso($recurso);        
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }    
    
}