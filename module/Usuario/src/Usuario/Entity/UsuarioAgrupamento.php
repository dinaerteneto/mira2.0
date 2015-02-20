<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioAgrupamento
 *
 * @ORM\Table(name="usuario_agrupamento", indexes={@ORM\Index(name="fk_usuario_agrupamento_usuario_grupo", columns={"id_usuario_grupo"}), @ORM\Index(name="fk_usuario_agrupamento_usuario", columns={"id_usuario"})})
 * @ORM\Entity
 */
class UsuarioAgrupamento
{
    /**
     * @var \Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    /**
     * @var \UsuarioGrupo
     *
     * @ORM\ManyToOne(targetEntity="UsuarioGrupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_grupo", referencedColumnName="id")
     * })
     */
    private $idUsuarioGrupo;

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdUsuarioGrupo() {
        return $this->idUsuarioGrupo;
    }

    public function setIdUsuario(Usuario $idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIdUsuarioGrupo(UsuarioGrupo $idUsuarioGrupo) {
        $this->idUsuarioGrupo = $idUsuarioGrupo;
    }


    
}

