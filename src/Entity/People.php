<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * People
 *
 * @ORM\Table(name="people")
 * @ORM\Entity
 * @ApiResource(
 * collectionOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_people"},"post"}
 *    }
 * },
 * itemOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_people_details"}}
 *    },
 *   "put",
 *   "patch",
 *   "delete"
 * })
 */
class People
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read_people", "read_people_details"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     * @Groups({"read_people", "read_people_details"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     * @Groups({"read_people", "read_people_details"}) 
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="date", nullable=false)
     * @Groups({"read_people", "read_people_details"})
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=255, nullable=false)
     * @Groups({"read_people", "read_people_details"})
     */
    private $nationality;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Movie", mappedBy="people")
     * @Groups({"read_people_details"})
     */
    private $movie = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movie = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of movie
     *
     * @return  \Doctrine\Common\Collections\Collection
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @param  \Doctrine\Common\Collections\Collection  $movie
     *
     * @return  self
     */
    public function setMovie(\Doctrine\Common\Collections\Collection $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of nationality
     *
     * @return  string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @param  string  $nationality
     *
     * @return  self
     */
    public function setNationality(string $nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return  string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of dateOfBirth
     *
     * @return  \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the value of dateOfBirth
     *
     * @param  \DateTime  $dateOfBirth
     *
     * @return  self
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}
