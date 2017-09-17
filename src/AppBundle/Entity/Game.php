<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game Entity
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 *
 */
class Game
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @Assert\Expression(
     *     "not (this.getHomeTeam() === this.getGuestTeam())",
     *     message="Home team con not equal guest team."
     * )
     *
     * Many Games have One home Team.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="homeGames")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id", nullable=false)
     */
    private $homeTeam;

    /**
     * Many Games have One guest Team.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="guestGames")
     * @ORM\JoinColumn(name="guest_team_id", referencedColumnName="id", nullable=false)
     */
    private $guestTeam;

    /**
     * @var integer $homeScore
     *
     * @ORM\Column(name="home_score", type="integer", nullable=true)
     */
    private $homeScore;

    /**
     * @var integer $guestScore
     *
     * @ORM\Column(name="guest_score", type="integer", nullable=true)
     */
    private $guestScore;

    /**
     * @var string $stadium
     *
     * @ORM\Column(name="stadium", type="string")
     */
    private $stadium;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var \DateTime $startedAt
     *
     * @ORM\Column(name="started_at", type="datetime")
     */
    private $startedAt;

    /**
     * One Game has Many Forecasts.
     *
     * @var Forecast[] $forecasts
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forecast", mappedBy="game")
     */
    private $forecasts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forecasts = new ArrayCollection();
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

    /**
     * Set homeScore
     *
     * @param integer $homeScore
     *
     * @return Game
     */
    public function setHomeScore($homeScore)
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * Get homeScore
     *
     * @return integer
     */
    public function getHomeScore()
    {
        return $this->homeScore;
    }

    /**
     * Set guestScore
     *
     * @param integer $guestScore
     *
     * @return Game
     */
    public function setGuestScore($guestScore)
    {
        $this->guestScore = $guestScore;

        return $this;
    }

    /**
     * Get guestScore
     *
     * @return integer
     */
    public function getGuestScore()
    {
        return $this->guestScore;
    }

    /**
     * Set stadium
     *
     * @param string $stadium
     *
     * @return Game
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium
     *
     * @return string
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Game
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set startedAt
     *
     * @param \DateTime $startedAt
     *
     * @return Game
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set homeTeam
     *
     * @param \AppBundle\Entity\Team $homeTeam
     *
     * @return Game
     */
    public function setHomeTeam(\AppBundle\Entity\Team $homeTeam = null)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set guestTeam
     *
     * @param \AppBundle\Entity\Team $guestTeam
     *
     * @return Game
     */
    public function setGuestTeam(\AppBundle\Entity\Team $guestTeam = null)
    {
        $this->guestTeam = $guestTeam;

        return $this;
    }

    /**
     * Get guestTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getGuestTeam()
    {
        return $this->guestTeam;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->startedAt->format('Y-m-d H:i') . ' ' . $this->stadium;
    }

    /**
     * Add forecast
     *
     * @param \AppBundle\Entity\Forecast $forecast
     *
     * @return Game
     */
    public function addForecast(\AppBundle\Entity\Forecast $forecast)
    {
        $this->forecasts[] = $forecast;

        return $this;
    }

    /**
     * Remove forecast
     *
     * @param \AppBundle\Entity\Forecast $forecast
     */
    public function removeForecast(\AppBundle\Entity\Forecast $forecast)
    {
        $this->forecasts->removeElement($forecast);
    }

    /**
     * Get forecasts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForecasts()
    {
        return $this->forecasts;
    }
}
