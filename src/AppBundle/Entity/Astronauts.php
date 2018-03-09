<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;

/**
 * Astronauts
 * @ORM\Entity
 * @ORM\Table(name="astronauts")
 */
class Astronauts
{
    /**
     * @var int
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
	 * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @var string
	 * @ORM\Column(type="string", length=64)
     */
    private $surname;

    /**
     * @var date
	 * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string
	 * @ORM\Column(type="string", length=64)
     */
    private $ability;


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
     * Set name
     *
     * @param string $name
     *
     * @return Astronauts
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
     * Set surname
     *
     * @param string $surname
     *
     * @return Astronauts
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Astronauts
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return date
     */
    public function getDate()
    {
		//$date = $this->date;
		//return $date->format('Y-m-d');
		return $this->date;
    }

    /**
     * Set ability
     *
     * @param string $ability
     *
     * @return Astronauts
     */
    public function setAbility($ability)
    {
        $this->ability = $ability;

        return $this;
    }

    /**
     * Get ability
     *
     * @return string
     */
    public function getAbility()
    {
        return $this->ability;
    }
}

