<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
    * @ORM\OneToMany(targetEntity="Bien", mappedBy="usuario")
    */
    private $bienes;

     /**
     * @ORM\ManyToMany(targetEntity="Rol", mappedBy="user", cascade={"all"}, orphanRemoval=true)
     */
    private $roles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function __construct()
    {
        $this->isActive = true;
        // puede no ser necesario, ver la sección salt debajo
        // $this->salt = md5(uniqid(null, true));
    }



    public function getSalt()
    {
        // podrías necesitar un verdadero salt dependiendo del encoder
        // ver la sección salt debajo
        return null;
    }



    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,

            $this->isActive
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // ver la sección salt debajo
            $this->isActive
            ) = unserialize($serialized);
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }


    /**
     * Add biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     *
     * @return User
     */
    public function addBiene(\BienesBundle\Entity\Bien $biene)
    {
        $this->bienes[] = $biene;

        return $this;
    }

    /**
     * Remove biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     */
    public function removeBiene(\BienesBundle\Entity\Bien $biene)
    {
        $this->bienes->removeElement($biene);
    }

    /**
     * Get bienes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBienes()
    {
        return $this->bienes;
    }

    /**
     * Add role
     *
     * @param \BienesBundle\Entity\Rol $role
     *
     * @return User
     */
    public function addRole(\BienesBundle\Entity\Rol $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \BienesBundle\Entity\Rol $role
     */
    public function removeRole(\BienesBundle\Entity\Rol $role)
    {
        $this->roles->removeElement($role);
    }

    public function __toString() {
        return strval($this->getId()); }
}
