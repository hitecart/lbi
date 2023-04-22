<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity
 * @ApiResource(
 * collectionOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_movie"}}
 *    },
 * "post"
 * },
 * itemOperations={
 *   "get"={
 *       "normalization_context"={"groups"={"read_movie_details"}}
 *    },
 *   "put",
 *   "patch",
 *   "delete",
 *  
 * }
 * )
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read_movie","read_movie_details","read_people_details"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Groups({"read_movie","read_movie_details","read_people_details"})
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     * @Groups({"read_movie","read_movie_details","read_people_details"})
     */
    private $duration;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="People", inversedBy="movie")
     * @ORM\JoinTable(name="movie_has_people",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Movie_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="People_id", referencedColumnName="id")
     *   }
     * )
     * @Groups({"read_movie","read_movie_details","read_people_details"})
     */
    private $people = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Type", inversedBy="movie")
     * @ORM\JoinTable(name="movie_has_type",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Movie_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Type_id", referencedColumnName="id")
     *   }
     * )
     * @Groups({"read_movie","read_movie_details","read_people_details"})
     */
    private $type = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->people = new \Doctrine\Common\Collections\ArrayCollection();
        $this->type = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get the value of title
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of duration
     *
     * @return  int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param  int  $duration
     *
     * @return  self
     */
    public function setDuration(int $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of people
     *
     * @return  \Doctrine\Common\Collections\Collection
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Set the value of people
     *
     * @param  \Doctrine\Common\Collections\Collection  $people
     *
     * @return  self
     */
    public function setPeople(\Doctrine\Common\Collections\Collection $people)
    {
        $this->people = $people;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  \Doctrine\Common\Collections\Collection
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  \Doctrine\Common\Collections\Collection  $type
     *
     * @return  self
     */
    public function setType(\Doctrine\Common\Collections\Collection $type)
    {
        $this->type = $type;

        return $this;
    }
}
