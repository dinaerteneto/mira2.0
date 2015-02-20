<?php

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Usuario\Form\Usuario as FormUsuario;

class IndexController extends AbstractActionController {

    public function registerAction() {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $form = new FormUsuario($objectManager);

        $usuario = new \Usuario\Entity\Usuario();
        $pessoa = new \Usuario\Entity\Pessoa();
        $form->bind($usuario);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $objectManager->persist($pessoa);
                $objectManager->flush();
                
                $usuario->setId($pessoa);
                $objectManager->persist($usuario);
                $objectManager->flush();
                
                $this->flashMessenger()
                    ->setNamespace('Usuario')
                    ->addMessage('Usuário cadastrado com sucesso');

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
        if ($result) {
            return new ViewModel(array('usuario' => $result));
        }
        return new ViewModel();
    }

}
