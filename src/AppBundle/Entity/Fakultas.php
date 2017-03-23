<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fakultas
 *
 * @ORM\Table(name="fakultas")
 * @ORM\Entity
 */
class Fakultas
{
    /**
     * @var string
     *
     * @ORM\Column(name="namafakultas", type="string", length=45, nullable=true)
     */
    private $namafakultas;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfakultas", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfakultas;



    /**
     * Set namafakultas
     *
     * @param string $namafakultas
     *
     * @return Fakultas
     */
    public function setNamafakultas($namafakultas)
    {
        $this->namafakultas = $namafakultas;

        return $this;
    }

    /**
     * Get namafakultas
     * @Assert\NotBlank(message="nama tidak boleh kosong")
     *
     * @return string
     */
    public function getNamafakultas()
    {
        return $this->namafakultas;
    }

    /**
     * Get idfakultas
     *
     * @return integer
     * @Assert\NotBlank(message="id tidak boleh kosong")
     * @Assert\Type(type="numeric",message="id harus Harus Dalam Bentuk Angka!!!")
     */
    public function getIdfakultas()
    {
        return $this->idfakultas;
    }
     public function setidfakultas($id){
       $this->idfakultas = $id;
       return $this;
     }
}
