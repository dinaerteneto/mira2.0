<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Acl;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
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
                'Acl\Form\AclPapel' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Acl\Entity\AclPapel');
                    $pai = $repository->fetchPairs();
                    return new Form\AclPapel($pai);
                },
                'Acl\Service\AclPapel' => function($sm) {
                    return new Service\AclPapel($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Acl\Service\AclRecurso' => function($sm) {
                    return new Service\AclRecurso($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Acl\Service\AclPrivilege' => function($sm) {
                    return new Service\AclPrivilegio($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Acl\Form\AclPrivilegio' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repositoryPapel = $em->getRepository('Acl\Entity\AclPapel');
                    $papel = $repositoryPapel->fetchPairs();
                    
                    $repositoryRecurso = $em->getRepository('Acl\Entity\AclRecurso');
                    $recurso = $repositoryRecurso->fetchPairs();                    
                    
                    return new Form\AclPrivilegio('privilegio', $papel, $recurso);
                },                    
            )
        );
    }

}
