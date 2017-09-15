<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team Entity
 *
 * @ORM\Table
 * @ORM\Entity
 * @Vich\Uploadable
 *
 */
class Team
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $logo;
    /**
     * @var File
     *
     * @Assert\File(
     *     maxSize = "2048k"
     * )
     * @Vich\UploadableField(mapping="team_logos", fileNameProperty="logo")
     */
    private $logoFile;

    /**
     * One Team has Many home Games.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="homeTeam")
     */
    private $homeGames;

    /**
     * One Team has Many guest Games.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="guestTeam")
     */
    private $guestGames;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set logo
     *
     * @param $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }
    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param File|null $logo
     */
    public function setLogoFile(File $logo = null)
    {
        $this->logoFile = $logo;
    }
    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->homeMatches = new \Doctrine\Common\Collections\ArrayCollection();
        $this->guestMatches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add homeMatch
     *
     * @param \AppBundle\Entity\Game $homeMatch
     *
     * @return Team
     */
    public function addHomeMatch(\AppBundle\Entity\Game $homeMatch)
    {
        $this->homeMatches[] = $homeMatch;

        return $this;
    }

    /**
     * Remove homeMatch
     *
     * @param \AppBundle\Entity\Game $homeMatch
     */
    public function removeHomeMatch(\AppBundle\Entity\Game $homeMatch)
    {
        $this->homeMatches->removeElement($homeMatch);
    }

    /**
     * Get homeMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * Add guestMatch
     *
     * @param \AppBundle\Entity\Game $guestMatch
     *
     * @return Team
     */
    public function addGuestMatch(\AppBundle\Entity\Game $guestMatch)
    {
        $this->guestMatches[] = $guestMatch;

        return $this;
    }

    /**
     * Remove guestMatch
     *
     * @param \AppBundle\Entity\Game $guestMatch
     */
    public function removeGuestMatch(\AppBundle\Entity\Game $guestMatch)
    {
        $this->guestMatches->removeElement($guestMatch);
    }

    /**
     * Get guestMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuestMatches()
    {
        return $this->guestMatches;
    }

    /**
     * Add homeGame
     *
     * @param \AppBundle\Entity\Game $homeGame
     *
     * @return Team
     */
    public function addHomeGame(\AppBundle\Entity\Game $homeGame)
    {
        $this->homeGames[] = $homeGame;

        return $this;
    }

    /**
     * Remove homeGame
     *
     * @param \AppBundle\Entity\Game $homeGame
     */
    public function removeHomeGame(\AppBundle\Entity\Game $homeGame)
    {
        $this->homeGames->removeElement($homeGame);
    }

    /**
     * Get homeGames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeGames()
    {
        return $this->homeGames;
    }

    /**
     * Add guestGame
     *
     * @param \AppBundle\Entity\Game $guestGame
     *
     * @return Team
     */
    public function addGuestGame(\AppBundle\Entity\Game $guestGame)
    {
        $this->guestGames[] = $guestGame;

        return $this;
    }

    /**
     * Remove guestGame
     *
     * @param \AppBundle\Entity\Game $guestGame
     */
    public function removeGuestGame(\AppBundle\Entity\Game $guestGame)
    {
        $this->guestGames->removeElement($guestGame);
    }

    /**
     * Get guestGames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuestGames()
    {
        return $this->guestGames;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
