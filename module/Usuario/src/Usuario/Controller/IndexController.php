<?php

namespace Usuario\Controller;

use Vivo\Mvc\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;
use Usuario\Form\Usuario as FormUsuario;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class IndexController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Usuario\Entity\Usuario';
        $this->form = 'Usuario\Form\Usuario';
        $this->service = 'Usuario\Service\Usuario';
        $this->controller = 'index';
        $this->route = 'usuario';
    }

    /**
     * Exibe o formulário de cadastro do usuário.
     * Quando enviado o post então chama o serviço para persistir os dados
     * @return ViewModel
     */
    public function createAction() {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new FormUsuario($objectManager);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get("Usuario\Service\Usuario");
                if ($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()
                        ->setNamespace('Usuario')
                        ->addMessage("Usuário cadastrado com sucesso");
                }
                return $this->redirect()->toRoute('usuario');
            }
        }

        $messages = $this->flashMessenger()
            ->setNamespace('Usuario')
            ->getMessages();

        return new ViewModel(array('form' => $form, 'messages' => $messages));
    }

    /**
     * altera os dados
     */
    public function updateAction() {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new FormUsuario($objectManager);

        $request = $this->getRequest();
        $repository = $objectManager->getRepository('Usuario\Entity\Usuario');
        $entity = $repository->find($this->params()->fromRoute('key', 0));
        
        if ($this->params()->fromRoute('key', 0)) {
            $array = array_merge($entity->toArray(), $entity->getId()->toArray());
            unset($array['senha']);
            $form->setData($array);
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form, 'key' => $this->params()->fromRoute('key', 0)));
    }

    /**
     * Faz a ativação do usuário e retorna uma view para informar sucesso ou fracasso
     * @return ViewModel
     */
    public function activateAction() {
        $activationKey = $this->params()->fromRoute('key');
        $userService = $this->getServiceLocator()->get('Usuario\Service\Usuario');
        $result = $userService->activate($activationKey);
        if ($result) {
            return new ViewModel(array('usuario' => $result));
        }
        return new ViewModel();
    }

}
