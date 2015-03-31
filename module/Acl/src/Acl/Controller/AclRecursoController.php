<?php

namespace Acl\Controller;

use Vivo\Mvc\Controller\AbstractCrudController;

class AclRecursoController extends AbstractCrudController {
    
    public function __construct() {
        $this->service = 'Acl\Service\AclRecurso';
        $this->entity = 'Acl\Entity\AclRecurso';
        $this->form = 'Acl\Form\AclRecurso';
        $this->controller = 'AclRecurso';
        $this->route = 'acl-admin/default';
    }
    
}