<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruang
 *
 * @ORM\Table(name="ruang")
 * @ORM\Entity
 */
class Ruang
{
    /**
     * @var string
     *
     * @ORM\Column(name="namaruang", type="string", length=45, nullable=true)
     */
    private $namaruang;

    /**
     * @var integer
     *
     * @ORM\Column(name="idruang", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idruang;



    /**
     * Set namaruang
     *
     * @param string $namaruang
     *
     * @return Ruang
     */
    public function setNamaruang($namaruang)
    {
        $this->namaruang = $namaruang;

        return $this;
    }

    /**
     * Get namaruang
     *
     * @return string
     */
    public function getNamaruang()
    {
        return $this->namaruang;
    }

    /**
     * Get idruang
     *
     * @return integer
     */
    public function getIdruang()
    {
        return $this->idruang;
    }
}
