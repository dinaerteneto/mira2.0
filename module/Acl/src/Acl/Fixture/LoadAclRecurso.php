<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Acl\Entity\AclRecurso;

class LoadAclRecurso extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        $recurso = new AclRecurso();
        $recurso->setNome('Posts');
        $manager->persist($recurso);
        
        $recurso = new AclRecurso();
        $recurso->setNome('Páginas');
        $manager->persist($recurso);        
        
        $manager->flush();
        
    }
    
    public function getOrder() {
        return 2;
    }
    
}
