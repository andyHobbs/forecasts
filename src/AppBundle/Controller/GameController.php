<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * GameController
 *
 * @author Andy Hobbs
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Game');

        $currentGames = $repository->getByStatus(1);
        $pastGames = $repository->getByStatus(2);
        $futureGames = $repository->getByStatus(3);

        return $this->render('AppBundle:game:index.html.twig', [
            'currentGames' => $currentGames,
            'pastGames' => $pastGames,
            'futureGames' => $futureGames
        ]);
    }
}
