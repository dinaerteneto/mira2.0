<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Acl\Entity\AclPapel;

class LoadAclPapel extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $papel = new AclPapel();
        $papel->setNome('Visitante');
        $manager->persist($papel);
        $manager->flush();

        $visitante = $manager->getReference('Acl\Entity\AclPapel', 1);

        $papel = new AclPapel();
        $papel->setNome('Registrado');
        $papel->setPai($visitante);
        $manager->persist($papel);

        $registrado = $manager->getReference('Acl\Entity\AclPapel', 2);

        $papel = new AclPapel();
        $papel->setNome('Redator');
        $papel->setPai($registrado);
        $manager->persist($papel);

        $papel = new AclPapel();
        $papel->setNome('Admin');
        $papel->setAdmin(true);
        $manager->persist($papel);

        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }

}
