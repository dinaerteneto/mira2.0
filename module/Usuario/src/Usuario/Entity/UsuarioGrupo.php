<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioGrupo
 *
 * @ORM\Table(name="usuario_grupo")
 * @ORM\Entity
 */
class UsuarioGrupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=4, nullable=true)
     */
    private $tipo;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }



}

