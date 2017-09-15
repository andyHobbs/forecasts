<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match Entity
 *
 * @ORM\Table
 * @ORM\Entity
 *
 */
class Match
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
     * @return Match
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
     * @return Match
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
     * @return Match
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
     * @return Match
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
}
