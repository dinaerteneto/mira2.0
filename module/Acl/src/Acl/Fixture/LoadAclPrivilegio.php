<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Acl\Entity\AclPrivilegio;

class LoadAclPrivilegio extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $papel1 = $manager->getReference('Acl\Entity\AclPapel', 1);
        $recurso1 = $manager->getReference('Acl\Entity\AclRecurso', 1);

        $papel3 = $manager->getReference('Acl\Entity\AclPapel', 3);
        $papel4 = $manager->getReference('Acl\Entity\AclPapel', 4);

        $privilegio = new AclPrivilegio();
        $privilegio->setNome("Visualizar");
        $privilegio->setPapel($papel1);
        $privilegio->setRecurso($recurso1);
        $manager->persist($privilegio);

        $privilegio = new AclPrivilegio();
        $privilegio->setNome("Novo / Editar");
        $privilegio->setPapel($papel3);
        $privilegio->setRecurso($recurso1);
        $manager->persist($privilegio);

        $privilegio = new AclPrivilegio();
        $privilegio->setNome("Excluir");
        $privilegio->setPapel($papel4);
        $privilegio->setRecurso($recurso1);
        
        $manager->persist($privilegio);
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}
