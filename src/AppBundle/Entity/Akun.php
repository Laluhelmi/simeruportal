<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Akun
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AkunRepository")
 * @ORM\Table(name="akun")
 * @ORM\Entity
 */
class Akun
{
    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", length=222, nullable=false)
     */
    private $nama;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=222, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return Akun
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     * @Assert\NotBlank(message="nama tidak boleh kosong")
     * @return string
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Akun
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     * @Assert\NotBlank(message="password tidak boleh kosong")
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
