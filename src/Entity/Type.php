<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity
 * @ApiResource(
 * collectionOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_type"}}
 *    },"post"
 * },
 * itemOperations={
 *  "get"={
 *       "normalization_context"={"groups"={"read_type_details"}}
 *    },
 *   "put",
 *   "patch",
 *   "delete"
 * })
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read_type","read_type_details"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Groups({"read_type","read_type_details"})     
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Movie", mappedBy="type")
     * @Groups({"read_type_details"})
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
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
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
}
