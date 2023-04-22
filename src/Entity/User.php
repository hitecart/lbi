<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"})
 * 
 * 
 * @ApiResource(
 * collectionOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_user"}}
 *    },"post"
 * },
 * itemOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_user_details"}}
 *    },
 *   "put",
 *   "patch",
 *   "delete"
 * 
 * })
 */
class User implements UserInterface
{

    const ROLE_USER = 'ROLE_USER';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read_user", "read_user_details"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank( message="Ne doit pas être vide")
     * @Groups({"read_user", "read_user_details"})
     * 
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Ne doit pas être vide")
     * @Assert\Email(message="Email invalide")
     * @Groups({"read_user", "read_user_details"})
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;




    public function __construct()
    {
        $this->role = 'ROLE_USER';
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * 
     */
    public function getRoles(): array
    {
        return [$this->role];
    }

    /**
     * Set the value of roles
     *
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }


    public function getUserIdentifier()
    {
        return $this->email;
    }



    public function eraseCredentials()
    {
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
