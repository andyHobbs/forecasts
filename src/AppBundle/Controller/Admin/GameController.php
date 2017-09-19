<?php

namespace AppBundle\Controller\Admin;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * GameController
 */
class GameController extends BaseAdminController
{
    /**
     * @return mixed
     */
    public function statisticsAction()
    {
        $game = $this->em->getRepository('AppBundle:Game')->find($this->request->query->get('id'));

        if ($game === null) {
            throw new NotFoundHttpException();
        }

        $rates = [
            ['Rates'],
            [count($game->getForecasts())]
        ];

        $histogram = new Histogram();
        $histogram->getData()->setArrayToDataTable($rates);
        $histogram->getOptions()->setTitle('Forecasts');
        $histogram->getOptions()->setWidth(900);
        $histogram->getOptions()->setHeight(500);
        $histogram->getOptions()->getLegend()->setPosition('none');
        $histogram->getOptions()->setColors(['#e7711c']);
        $histogram->getOptions()->getHistogram()->setLastBucketPercentile(0.1);
        $histogram->getOptions()->getHistogram()->setBucketSize(10);


        return $this->render(':easy_admin/Game:statistics.html.twig', [
            'histogram' => $histogram
        ]);
    }

}
