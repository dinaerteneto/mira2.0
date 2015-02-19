<?php

namespace Usuario\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Usuario\Entity\Pessoa;

class LoadUser extends AbstractFixture {

    public function load(ObjectManager $manager) {
        $pessoa = new Pessoa();
        $pessoa->setNome('Elissandra');
        $pessoa->setDataNascimento(new \DateTime("now"));
        $manager->persist($pessoa);
        
        $pessoa = new Pessoa();
        $pessoa->setNome('Dinaerte');
        $pessoa->setDataNascimento(new \DateTime("now"));
        $manager->persist($pessoa);
                
        $manager->flush();
    }

}
