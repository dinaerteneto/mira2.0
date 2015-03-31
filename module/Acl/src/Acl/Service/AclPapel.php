<?php

namespace Acl\Service;

use Vivo\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class AclPapel extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\AclPapel';
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);
        if ($data['pai']) {
            $papelPai = $this->em->getReference($this->entity, $data['pai']);
            $entity->setPai($papelPai);
        } else {
            $entity->setPai(null);
        }
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        if ($data['pai']) {
            $papelPai = $this->em->getReference($this->entity, $data['pai']);
            $entity->setPai($papelPai);
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}