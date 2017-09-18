<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Game;
use AppBundle\Entity\User;
use AppBundle\Entity\Forecast;

/**
 * ForecastExtension
 */
class ForecastExtension extends \Twig_Extension
{

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('rate', [$this, 'rateWidget'])
        ];
    }

    /**
     * @param Game $game
     *
     * @return string
     */
    public function rateWidget($game)
    {
        /** @var Forecast $rate */
        $rate = $game->getForecasts()->first();

        $message = 'Not set';
        if ($rate) {
            $message = $rate->getHomeRate() . ':' . $rate->getGuestRate();
        }

        return $message;
    }

}