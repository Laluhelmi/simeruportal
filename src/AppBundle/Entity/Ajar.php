<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Ajar
 *
 * @ORM\Table(name="ajar", indexes={@ORM\Index(name="fk_dosen_has_matakuliah_matakuliah1_idx", columns={"matakuliah_idmatkul"}), @ORM\Index(name="fk_dosen_has_matakuliah_dosen1_idx", columns={"dosen_nip"}), @ORM\Index(name="fk_ajar_ruang1_idx", columns={"ruang_idruang"})})
 * @ORM\Entity
 */
class Ajar
{
    /**
     * @var string
     *
     * @ORM\Column(name="kelas", type="string", length=45, nullable=true)
     */
    private $kelas;

    /**
     * @var string
     *
     * @ORM\Column(name="jam", type="string", length=45, nullable=true)
     */
    private $jam;

    /**
     * @var string
     *
     * @ORM\Column(name="hari", type="string", length=45, nullable=true)
     */
    private $hari;

    /**
     * @var integer
     *
     * @ORM\Column(name="idajar", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idajar;

    /**
     * @var \AppBundle\Entity\Matakuliah
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Matakuliah")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matakuliah_idmatkul", referencedColumnName="idmatkul")
     * })
     */
    private $matakuliahmatkul;

    /**
     * @var \AppBundle\Entity\Dosen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dosen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dosen_nip", referencedColumnName="nip")
     * })
     */
    private $dosenNip;

    /**
     * @var \AppBundle\Entity\Ruang
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ruang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ruang_idruang", referencedColumnName="idruang")
     * })
     */
    private $ruangruang;



    /**
     * Set kelas
     *
     * @param string $kelas
     *
     * @return Ajar
     */
    public function setKelas($kelas)
    {
        $this->kelas = $kelas;

        return $this;
    }

    /**
     * Get kelas
     * @return string
     */
    public function getKelas()
    {
        return $this->kelas;
    }

    /**
     * Set jam
     *
     * @param string $jam
     *
     * @return Ajar
     */
    public function setJam($jam)
    {
        $this->jam = $jam;

        return $this;
    }

    /**
     * Get jam
     *
     * @Assert\NotBlank(message="jam tidak boleh kosong")
     * @return string
     */
    public function getJam()
    {
        return $this->jam;
    }

    /**
     * Set hari
     *
     * @param string $hari
     *
     * @return Ajar
     */
    public function setHari($hari)
    {
        $this->hari = $hari;

        return $this;
    }

    /**
     * Get hari
     *
     * @return string
     */
    public function getHari()
    {
        return $this->hari;
    }

    /**
     * Get idajar
     *
     * @return integer
     */
    public function getIdajar()
    {
        return $this->idajar;
    }

    /**
     * Set matakuliahmatkul
     *
     * @param \AppBundle\Entity\Matakuliah $matakuliahmatkul
     *
     * @return Ajar
     */
    public function setMatakuliahmatkul(\AppBundle\Entity\Matakuliah $matakuliahmatkul = null)
    {
        $this->matakuliahmatkul = $matakuliahmatkul;

        return $this;
    }

    /**
     * Get matakuliahmatkul
     *
     * @return \AppBundle\Entity\Matakuliah
     */
    public function getMatakuliahmatkul()
    {
        return $this->matakuliahmatkul;
    }

    /**
     * Set dosenNip
     *
     * @param \AppBundle\Entity\Dosen $dosenNip
     *
     * @return Ajar
     */
    public function setDosenNip(\AppBundle\Entity\Dosen $dosenNip = null)
    {
        $this->dosenNip = $dosenNip;

        return $this;
    }

    /**
     * Get dosenNip
     *
     * @return \AppBundle\Entity\Dosen
     */
    public function getDosenNip()
    {
        return $this->dosenNip;
    }

    /**
     * Set ruangruang
     *
     * @param \AppBundle\Entity\Ruang $ruangruang
     *
     * @return Ajar
     */
    public function setRuangruang(\AppBundle\Entity\Ruang $ruangruang = null)
    {
        $this->ruangruang = $ruangruang;

        return $this;
    }

    /**
     * Get ruangruang
     *
     * @return \AppBundle\Entity\Ruang
     */
    public function getRuangruang()
    {
        return $this->ruangruang;
    }
}
