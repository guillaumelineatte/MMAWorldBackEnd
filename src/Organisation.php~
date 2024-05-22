<?php
// src/Organisations.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'organisations')]
class Organisation
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string')]
    private string $country;
    #[ORM\Column(type: 'string')]
    private string $founder;
    #[ORM\Column(type: 'integer')]
    private int $roster;
    #[ORM\Column(type: 'string')]
    private string $logo;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Organisation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Organisation
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set founder.
     *
     * @param string $founder
     *
     * @return Organisation
     */
    public function setFounder($founder)
    {
        $this->founder = $founder;

        return $this;
    }

    /**
     * Get founder.
     *
     * @return string
     */
    public function getFounder()
    {
        return $this->founder;
    }

    /**
     * Set roster.
     *
     * @param int $roster
     *
     * @return Organisation
     */
    public function setRoster($roster)
    {
        $this->roster = $roster;

        return $this;
    }

    /**
     * Get roster.
     *
     * @return int
     */
    public function getRoster()
    {
        return $this->roster;
    }

    /**
     * Set logo.
     *
     * @param string $logo
     *
     * @return Organisation
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
