<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Forecast Entity
 *
 * @ORM\Table
 * @ORM\Entity
 *
 */
class Forecast
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
     * Many Forecasts have One User.
     *
     * @var User $user
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="forecasts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Forecasts have One Game.
     *
     * @var Game $game
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Game", inversedBy="forecasts")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    /**
     * @var integer $homeScore
     *
     * @ORM\Column(name="home_rate", type="integer")
     */
    private $homeRate;

    /**
     * @var integer $guestScore
     *
     * @ORM\Column(name="guest_rate", type="integer")
     */
    private $guestRate;

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
     * Set homeRate
     *
     * @param integer $homeRate
     *
     * @return Forecast
     */
    public function setHomeRate($homeRate)
    {
        $this->homeRate = $homeRate;

        return $this;
    }

    /**
     * Get homeRate
     *
     * @return integer
     */
    public function getHomeRate()
    {
        return $this->homeRate;
    }

    /**
     * Set guestRate
     *
     * @param integer $guestRate
     *
     * @return Forecast
     */
    public function setGuestRate($guestRate)
    {
        $this->guestRate = $guestRate;

        return $this;
    }

    /**
     * Get guestRate
     *
     * @return integer
     */
    public function getGuestRate()
    {
        return $this->guestRate;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Forecast
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Forecast
     */
    public function setGame(\AppBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
