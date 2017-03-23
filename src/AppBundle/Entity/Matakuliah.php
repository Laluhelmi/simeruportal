<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Matakuliah
 *
 * @ORM\Table(name="matakuliah", indexes={@ORM\Index(name="fk_matakuliah_program_studi1_idx", columns={"program_studi_idprogram_studi"})})
 * @ORM\Entity
 */
class Matakuliah
{
    /**
     * @var string
     *
     * @ORM\Column(name="nama_matkul", type="string", length=45, nullable=true)
     */
    private $namaMatkul;

    /**
     * @var integer
     *
     * @ORM\Column(name="sks", type="integer", nullable=true)
     */
    private $sks;

    /**
     * @var integer
     *
     * @ORM\Column(name="semester", type="integer", nullable=true)
     */
    private $semester;

    /**
     * @var integer
     *
     * @ORM\Column(name="idmatkul", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmatkul;

    /**
     * @var \AppBundle\Entity\ProgramStudi
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProgramStudi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_studi_idprogram_studi", referencedColumnName="idprogram_studi")
     * })
     */
    private $programStudiprogramStudi;



    /**
     * Set namaMatkul
     *
     * @param string $namaMatkul
     *
     * @return Matakuliah
     */
    public function setNamaMatkul($namaMatkul)
    {
        $this->namaMatkul = $namaMatkul;

        return $this;
    }

    /**
     * Get namaMatkul
     * @Assert\NotBlank(message="nama tidak boleh kosong")
     * @return string
     */
    public function getNamaMatkul()
    {
        return $this->namaMatkul;
    }

    /**
     * Set sks
     *
     * @param integer $sks
     *
     * @return Matakuliah
     */
    public function setSks($sks)
    {
        $this->sks = $sks;

        return $this;
    }

    /**
     * Get sks
     *
     * @Assert\NotBlank(message="sks tidak boleh kosong")
     * @Assert\Type(type="numeric",message="sks harus Harus Dalam Bentuk Angka!!!")
     * @return integer
     */
    public function getSks()
    {
        return $this->sks;
    }

    /**
     * Set semester
     *
     * @param integer $semester
     *
     * @return Matakuliah
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
    * @Assert\NotBlank(message="semester matak kuliah tidak boleh kosong")
    * @Assert\Type(type="numeric",message="semester harus Harus Dalam Bentuk Angka!!!")
     * @return integer
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Get idmatkul
     *
     * @Assert\NotBlank(message="id matak kuliah tidak boleh kosong")
     * @return integer
     */
    public function getIdmatkul()
    {
        return $this->idmatkul;
    }

    public function setIdmatkul($idmatkul){
      $this->idmatkul = $idmatkul;
      return $this;
    }
    /**
     * Set  programStudi
     *
     * @param \AppBundle\Entity\ProgramStudi $programStudiprogramStudi
     *
     * @return Matakuliah
     */
    public function setProgramStudiprogramStudi(\AppBundle\Entity\ProgramStudi $programStudiprogramStudi = null)
    {
        $this->programStudiprogramStudi = $programStudiprogramStudi;

        return $this;
    }

    /**
     * Get programStudiprogramStudi
     *
     * @return \AppBundle\Entity\ProgramStudi
     */
    public function getProgramStudiprogramStudi()
    {
        return $this->programStudiprogramStudi;
    }
}
