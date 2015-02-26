<?php

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Usuario\Form\Login as LoginForm;

class AuthController extends AbstractActionController {
    
    public function indexAction() {
        $error = false;
        $form = new LoginForm();
        
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $data = $request->getPost()->toArray();
                $sessionStorage = new SessionStorage();
                
                $auth = new AuthenticationService();
                $auth->setStorage($sessionStorage);
                
                $authAdapter = $this->getServiceLocator()->get('Usuario\Auth\Adapter');
                $authAdapter->setLogin($data['login']);
                $authAdapter->setSenha($data['senha']);
                
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    $usuario = $auth->getIdentity();
                    $usuario = $usuario['usuario'];
                    $sessionStorage->write($usuario, null);
                    
                    return $this->redirect()->toRoute('usuario', array('controller' => 'index'));
                } else {
                    $error = true;
                }
            }
        }
        return new ViewModel(array('form' => $form, 'error' => $error));
    }
    
    public function logoutAction() {
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage());
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('usuario-auth');
    }
}
