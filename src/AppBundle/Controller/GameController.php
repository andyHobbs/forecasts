<?php

namespace AppBundle\Controller;

use AppBundle\DBAL\Types\GameStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * GameController
 *
 * @author Andy Hobbs <andyhobbs92@gmail.com>
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Game');

        $currentGames = $repository->getByStatus(GameStatusType::CURRENT);
        $futureGames = $repository->getByStatus(GameStatusType::FUTURE);
        $pastGames = $repository->getByStatus(GameStatusType::PAST);

        return $this->render('AppBundle:game:index.html.twig', [
            'currentGames' => $currentGames,
            'futureGames'  => $futureGames,
            'pastGames'    => $pastGames
        ]);
    }
}
