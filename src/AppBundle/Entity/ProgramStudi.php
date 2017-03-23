<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProgramStudi
 *
 * @ORM\Table(name="program_studi", indexes={@ORM\Index(name="fk_program_studi_fakultas1_idx", columns={"fakultas_idfakultas"})})
 * @ORM\Entity
 */
class ProgramStudi
{
    /**
     * @var string
     *
     * @ORM\Column(name="nama_prodi", type="string", length=45, nullable=true)
     */
    private $namaProdi;

    /**
     * @var string
     *
     * @ORM\Column(name="kampus", type="string", length=45, nullable=true)
     */
    private $kampus;

    /**
     * @var integer
     *
     * @ORM\Column(name="idprogram_studi", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprogramStudi;

    /**
     * @var \AppBundle\Entity\Fakultas
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fakultas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fakultas_idfakultas", referencedColumnName="idfakultas")
     * })
     */
    private $fakultasfakultas;



    /**
     * Set namaProdi
     *
     * @param string $namaProdi
     *
     * @return ProgramStudi
     */
    public function setNamaProdi($namaProdi)
    {
        $this->namaProdi = $namaProdi;

        return $this;
    }

    /**
     * Get namaProdi
     * @Assert\NotBlank(message="nama prodi tidak boleh kosong")
     * @return string
     */
    public function getNamaProdi()
    {
        return $this->namaProdi;
    }

    /**
     * Set kampus
     *
     * @param string $kampus
     *
     * @return ProgramStudi
     */
    public function setKampus($kampus)
    {
        $this->kampus = $kampus;

        return $this;
    }

    /**
     * Get kampus
     * @Assert\NotBlank(message="kampus tidak boleh kosong")
     * @return string
     */
    public function getKampus()
    {
        return $this->kampus;
    }

    /**
     * Get idprogramStudi
     * @Assert\NotBlank(message="id tidak boleh kosong")
    *  @Assert\Type(type="numeric",message="id harus Harus Dalam Bentuk Angka!!!")
     * @return integer
     */
    public function getIdprogramStudi()
    {
        return $this->idprogramStudi;
    }
    /**
     * set idprogramStudi
     *
     * @return integer
     */
    public function setIdprogramStudi($id)
    {
        $this->idprogramStudi = $id;
        return $this;
    }

    /**
     * Set fakultasfakultas
     *
     * @param \AppBundle\Entity\Fakultas $fakultasfakultas
     *
     * @return ProgramStudi
     */
    public function setFakultasfakultas(\AppBundle\Entity\Fakultas $fakultasfakultas = null)
    {
        $this->fakultasfakultas = $fakultasfakultas;

        return $this;
    }

    /**
     * Get fakultasfakultas
     *
     * @return \AppBundle\Entity\Fakultas
     */
    public function getFakultasfakultas()
    {
        return $this->fakultasfakultas;
    }
}
