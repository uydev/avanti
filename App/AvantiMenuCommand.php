<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Classes\Satellite;
use GuzzleHttp\Exception\GuzzleException;

class AvantiMenuCommand extends Command
{
    /**
     * @var
     */
    private $io;

    /**
     * MenuCommand constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct('menu');

        $this->setDescription('Avanti Menu');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);


        $session = new Satellite();

        $choices = ['A' => 'List Satellites', 'B' => 'Get Satellite Report', 'C' => 'Get Satellite Positions', 'D' => 'Calculate Distance', false => 'Exit Application'];

        echo "\n";

        $choice = $this->io->choice('Please choose from the menu', $choices);

        while ($choice) {

            $output->write(sprintf("\033\143"));

            $method = 'option' . $choice;

            $this->$method($session);
            echo "\n\n\n";
            $choice = $this->io->choice('Please choose from the menu', $choices);

            echo "\n";

        }
        return null;
    }

    /**
     * @param Satellite $session
     * @throws GuzzleException
     */
    private function optionA(Satellite $session)
    {
        $this->io->writeln('List Satellites:');
        echo $session->listSatellites();
    }

    /**
     * @param Satellite $session
     * @throws GuzzleException
     */
    private function optionB(Satellite $session)
    {
        $this->io->writeln('Satellite Report');
        $id = (int)$this->io->ask('Satellite ID:');
        echo $session->getSatelliteReport($id);
    }

    /**
     * @param Satellite $session
     * @throws GuzzleException
     */
    private function optionC(Satellite $session)
    {
        $this->io->writeln('Satellite Positions');
        $id = (int)$this->io->ask('Satellite ID:');
        $timestamp = time();
        echo $session->getSatellitePositions($id, $timestamp);
    }

    /**
     * @param Satellite $session
     * @throws GuzzleException
     */
    private function optionD(Satellite $session)
    {
        $id = '25544';
        $timestamp = time();
        $report = json_decode($session->getSatellitePositions($id, $timestamp));

        $reportLatitude = $report[0]->latitude;
        $reportLongitude = $report[0]->longitude;

        $this->io->writeln('Calculate Distance');
        $longitude = (int)$this->io->ask('Longitude:');
        $latitude = (int)$this->io->ask('Latitude:');
        echo $session->haversineGreatCircleDistance($longitude, $latitude, $reportLatitude, $reportLongitude) . ' KM';
    }
}
