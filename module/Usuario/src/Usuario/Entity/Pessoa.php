<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa", uniqueConstraints={@ORM\UniqueConstraint(name="cpf", columns={"cpf"})})
 * @ORM\Entity
 */
class Pessoa
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=15, nullable=false)
     */
    private $cpf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adicionado_em", type="datetime", nullable=false)
     */
    private $adicionadoEm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alterado_em", type="datetime", nullable=false)
     */
    private $alteradoEm;


}

