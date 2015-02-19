<?php

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Usuario\Form\Pessoa as FormPessoa;

class IndexController extends AbstractActionController {

    public function registerAction() {
        $form = new FormPessoa();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('Usuario\Service\Usuario');
                if ($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()
                        ->setNamespace('Usuario')
                        ->addMessage('Usuário cadastrado com sucesso');
                }
                return $this->redirect()->toRoute('usuario-register');
            }
        }

        $messages = $this->flashMessenger()
            ->setNamespace('Usuario')
            ->getMessages();

        return new ViewModel(array('form' => $form, 'messages' => $messages));
    }
    
    public function activateAction() {
        $activationKey = $this->params()->toRoute('key');
        $userService = $this->getServiceLocator()->get('Usuario\Service\Usuario');
        $result = $userService->active($activationKey);
        if($result) {
            return new ViewModel(array('usuario' => $result));
        }
        return new ViewModel();
    }

}
