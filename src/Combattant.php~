<?php
// src/Combattants.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'combattants')]
class Combattant
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string')]
    private string $surname;
    #[ORM\Column(type: 'string')]
    private string $pseudo;
    #[ORM\Column(type: 'integer')]
    private int $age;
    #[ORM\Column(type: 'integer')]
    private int $poids;
    #[ORM\Column(type: 'integer')]
    private int $taille;
    #[ORM\Column(type: 'integer')]
    private int $allonge;
    #[ORM\Column(type: 'string')]
    private string $photo;
    #[ORM\Column(type: 'integer')]
    private int $victoire;
    #[ORM\Column(type: 'integer')]
    private int $defaite;
    #[ORM\Column(type: 'integer')]
    private int $egalite;
    #[ManyToOne(targetEntity:Nationalite::class)]
    #[JoinColumn(name: 'nationalite_id', referencedColumnName: 'id')]
    private Nationalite|null $nationalite = null;


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
     * @return Combattant
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
     * Set surname.
     *
     * @param string $surname
     *
     * @return Combattant
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set pseudo.
     *
     * @param string $pseudo
     *
     * @return Combattant
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo.
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return Combattant
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set poids.
     *
     * @param int $poids
     *
     * @return Combattant
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids.
     *
     * @return int
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set taille.
     *
     * @param int $taille
     *
     * @return Combattant
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille.
     *
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set allonge.
     *
     * @param int $allonge
     *
     * @return Combattant
     */
    public function setAllonge($allonge)
    {
        $this->allonge = $allonge;

        return $this;
    }

    /**
     * Get allonge.
     *
     * @return int
     */
    public function getAllonge()
    {
        return $this->allonge;
    }

    /**
     * Set photo.
     *
     * @param string $photo
     *
     * @return Combattant
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo.
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set victoire.
     *
     * @param int $victoire
     *
     * @return Combattant
     */
    public function setVictoire($victoire)
    {
        $this->victoire = $victoire;

        return $this;
    }

    /**
     * Get victoire.
     *
     * @return int
     */
    public function getVictoire()
    {
        return $this->victoire;
    }

    /**
     * Set defaite.
     *
     * @param int $defaite
     *
     * @return Combattant
     */
    public function setDefaite($defaite)
    {
        $this->defaite = $defaite;

        return $this;
    }

    /**
     * Get defaite.
     *
     * @return int
     */
    public function getDefaite()
    {
        return $this->defaite;
    }

    /**
     * Set egalite.
     *
     * @param int $egalite
     *
     * @return Combattant
     */
    public function setEgalite($egalite)
    {
        $this->egalite = $egalite;

        return $this;
    }

    /**
     * Get egalite.
     *
     * @return int
     */
    public function getEgalite()
    {
        return $this->egalite;
    }

    /**
     * Set nationalite.
     *
     * @param \Nationalite|null $nationalite
     *
     * @return Combattant
     */
    public function setNationalite(\Nationalite $nationalite = null)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite.
     *
     * @return \Nationalite|null
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }
}
