<?php

namespace Acl\Controller;

use Vivo\Mvc\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class AclPrivilegioController extends AbstractCrudController {
    
    public function __construct() {
        $this->service = 'Acl\Service\AclPrivilegio';
        $this->entity = 'Acl\Entity\AclPrivilegio';
        $this->form = 'Acl\Form\AclPrivilegio';
        $this->controller = 'AclPrivilegio';
        $this->route = 'acl-admin/default';
    }
    
    /**
     * persiste os dados
     */
    public function createAction() {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }    
    
    /**
     * altera os dados
     */
    public function updateAction() {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $form->setData($entity->toArray());
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }    
    
}