<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Dosen
 *
 * @ORM\Table(name="dosen")
 * @ORM\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AkunRepository")
 */
class Dosen
{
    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", length=45, nullable=true)
     */
    private $nama;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=122)
     */
    private $nip;



    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return Dosen
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     *@Assert\NotBlank(message="nama tidak boleh kosong")
     * @return string
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Get nip
     *@Assert\NotBlank(message="nip tidak boleh kosong")
     * @return string
     */
    public function getNip()
    {
        return $this->nip;
    }
    /**
     * Set nip
     *
     * @param string $nip
     *
     * @return Dosen
     */
    public function setNip($nip){
          $this->nip = $nip;
          return $this;
    }
}
