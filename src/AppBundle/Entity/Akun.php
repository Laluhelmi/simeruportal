<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
/**
 * Akun
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AkunRepository")
 * @ORM\Table(name="akun")
 * @ORM\Entity
 */
class Akun implements UserInterface, EncoderAwareInterface,\Serializable
{

  /**
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=222, nullable=false)
   */
    private $level;
    public function setLevel($level)
    {
      $this->level = $level;
      return $this;
    }
    public function getLevel()
    {
      return $this->level;
    }
      public function getEncoderName()
     {

         return null; // use the default encoder
     }
     public function getSalt()
     {
       return null;
     }
     public function getUsername()
     {
        return null;
     }
     /** @see \Serializable::serialize() */
     public function serialize()
     {
      return serialize(array(
          $this->id,
          $this->nama,
          $this->level,
          $this->password,
          // see section on salt below
          // $this->salt,
      ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nama,
            $this->level,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
     public function eraseCredentials()
     {
       return null;
     }
     public function getRoles(){
       return array('ROLE_ADMIN','ROLE_USER');
     }
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
