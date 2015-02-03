<?php

namespace Pessoa\Model;

use Doctrine\ORM\Mapping as ORM;
use Vivo\Entity\AbstractEntity;
use Vivo\InputFilter\InputFilter;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity
 * @ORM\Table(name="Pessoa.pessoa")
 */
class Pessoa extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * var int
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $area_id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $status_id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $re;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $data_nascimento;

    /**
     * @ORM\Column(type="date")
     * @var string
     */
    protected $data_cadastro;

    
    public function getId() {
        return $this->id;
    }

    public function getAreaId() {
        return $this->area_id;
    }

    public function getStatusId() {
        return $this->status_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getRe() {
        return $this->re;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setAreaId($area_id) {
        $this->area_id = $area_id;
    }

    public function setStatusId($status_id) {
        $this->status_id = $status_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setRe($re) {
        $this->re = $re;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }
    
    public function setUsuario(Pessoa\Model\Usuario $usuario) {
        $this->usuario = $usuario;
    }
    
    public function getUsuario() {
        $em = $GLOBALS['entityManager'];
        return $em->getRepository('\Pessoa\Model\Usuario')->findOneBy(array('id' => $this->getId()));
    }
    
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('nome', new StripTags());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addValidator('nome', new StringLength(array(
                'enconding' => 'UTF-8',
                'min' => 5,
                'max' => 255
                )
                )
            );
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
       
}
