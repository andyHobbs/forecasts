<?php

namespace AppBundle\Controller;

use AppBundle\Form\RateType;
use AppBundle\Entity\Forecast;
use AppBundle\DBAL\Types\GameStatusType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        //$user = $this->getUser();

        $currentGames = $repository->getByStatus(GameStatusType::CURRENT);
        $futureGames = $repository->getByStatus(GameStatusType::FUTURE);
        $pastGames = $repository->getByStatus(GameStatusType::PAST);

        return $this->render('AppBundle:game:index.html.twig', [
            'currentGames' => $currentGames,
            'futureGames'  => $futureGames,
            'pastGames'    => $pastGames,
            'form'         => $this->createForm(RateType::class, new Forecast())->createView()
        ]);
    }

    /**
     * @Route("/ajax-new-rate", name="ajax_new_rate")
     *
     * @param Request $request
     *
     * @throws BadRequestHttpException
     *
     * @return JsonResponse
     */
    public function ajaxNewRate(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Bad Request');
        }

        $user = $this->getUser();

        if ($user == null) {
            throw new AccessDeniedException('Auth required');
        }

        $dm = $this->getDoctrine();
        $game = $dm->getRepository('AppBundle:Game')->find($request->get('game'));

        $forecast = new Forecast();

        $form = $this->createForm(RateType::class, $forecast);

        $form->handleRequest($request);

        $forecast->setUser($user);
        $forecast->setGame($game);

        if ($form->isValid()) {
            $em = $dm->getManager();
            $em->persist($forecast);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success'
            ]);
        }

        return new JsonResponse([
            'message' => 'Error',
            'form'    => $form->createView()
        ], 400);
    }
}
