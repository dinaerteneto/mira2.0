<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport,
    Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Zend\ModuleManager\ModuleManager;

use Usuario\Auth\Adapter as AuthAdapter;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function init(ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController", MvcEvent::EVENT_DISPATCH, array($this, 'validateAuth'), 100);
    }
    
    public function validateAuth($e) {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        
        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
        
        if(!$auth->hasIdentity() and $matchedRoute != "usuario-auth") {
            return $controller->redirect()->toRoute("usuario-auth");
        }
    }
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    'Vivo' => realpath(__DIR__ . '/../../vendor/vivoframework/vivoframework/library/Vivo')
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Usuario\Mail\Transport' => function ($sm) {
                    $config = $sm->get('Config');

                    $transport = new SmtpTransport();
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);

                    return $transport;
                },
                'Usuario\Service\Usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'), $sm->get('Usuario\Mail\Transport'), $sm->get('View'));
                },
                'Usuario\Auth\Adapter' => function($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                }
                
            )
        );
    }


}
