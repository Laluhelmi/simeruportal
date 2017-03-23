<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mahasiswa
 *
 * @ORM\Table(name="mahasiswa")
 * @ORM\Entity
 */
class Mahasiswa
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=222, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alamat", type="text", length=65535, nullable=false)
     */
    private $alamat;

    /**
     * @var string
     *
     * @ORM\Column(name="nim", type="string", length=222)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nim;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Mahasiswa
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set alamat
     *
     * @param string $alamat
     *
     * @return Mahasiswa
     */
    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;

        return $this;
    }

    /**
     * Get alamat
     *
     * @return string
     */
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * Get nim
     *
     * @return string
     */
    public function getNim()
    {
        return $this->nim;
    }
}
