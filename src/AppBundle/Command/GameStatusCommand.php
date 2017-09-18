<?php

namespace AppBundle\Command;

use AppBundle\DBAL\Types\GameStatusType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * GameStatusCommand
 */
class GameStatusCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('app:game-status')
            ->setDescription('Update game status.')
            ->setHelp('Changes game status depending on time.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getContainer()->get('doctrine');

        $em = $dm->getManager();

        $games = $dm->getRepository('AppBundle:Game')->findAll();

        $output->writeln([
            'Run script',
            '============',
            '',
        ]);

        foreach ($games as $game) {
            $gameStart = $game->getStartedAt();
            if ($gameStart > (new \DateTime())->modify('-1 hour') && $gameStart < (new \DateTime())->modify('+105 minutes')) {
                $game->setStatus(GameStatusType::CURRENT);
                $output->writeln([
                    $game->getId() . ': set current.'
                ]);
            }

            if ($gameStart->modify('+105 minutes') < new \DateTime()) {
                $game->setStatus(GameStatusType::PAST);
                $output->writeln([
                    $game->getId() . ': set past.'
                ]);
            }

            $em->persist($game);

        }

        $em->flush();

        $output->writeln([
            '',
            '============',
            'Script finish'
        ]);


    }

}
