<?php

namespace Acl\Service;

use Vivo\Service\AbstractService;

class AclRecurso extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\AclRecurso';
    }

}