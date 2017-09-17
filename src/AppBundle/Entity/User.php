<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookId;

    /**
     * @var string
     */
    private $facebookAccessToken;

    /**
     * One User has Many Forecasts.
     *
     * @var Forecast[] $forecasts
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forecast", mappedBy="user")
     */
    private $forecasts;

    /**
     * User Constructor
     */
    public function __construct()
    {
        $this->forecasts = new ArrayCollection();

        parent::__construct();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }


    /**
     * Add forecast
     *
     * @param \AppBundle\Entity\Forecast $forecast
     *
     * @return User
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
