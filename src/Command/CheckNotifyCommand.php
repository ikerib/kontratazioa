<?php

namespace App\Command;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckNotifyCommand extends Command
{
    protected static $defaultName = 'app:check-notify';
    protected static $defaultDescription = 'Jakinerazpenik dagoen begiratu, baldin badago bidali.';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $notifications = $this->entityManager->getRepository(Notification::class)->getAllUnNotified();
        $rows = [];
        /** @var Notification $notification */
        foreach ($notifications as $notification) {
            $fetxa = $notification->getNoiz()->format('Y-m-d');
            $curr = date('Y-m-d');
            if ( $fetxa === $curr ) {
                $io->writeln($notification->getLote() . ' ==> ' . $fetxa);
                $row = [$notification->getLote(), $fetxa];
                $rows[] = $row;
            }
        }
        $io->table(['Lote', 'Fetxa'], $rows);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
