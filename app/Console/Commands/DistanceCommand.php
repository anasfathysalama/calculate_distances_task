<?php

namespace App\Console\Commands;

use App\Services\AddressService;
use App\Services\GeoLocationService;
use Illuminate\Console\Command;

class DistanceCommand extends Command
{

    protected GeoLocationService $locationService;

    public function __construct(GeoLocationService $locationService)
    {
        parent::__construct();
        $this->locationService = $locationService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:distances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the	distance in	kilometres from	each address to	the	Adchieve headquarters.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->locationService->calcGeolocationDistances();
        foreach ($data['addressesLocation'] as $location) {
            echo "{$location['Sortnumber']},{$location['Distance']},{$location['Name']},{$location['Address']}" . PHP_EOL;
        }
        $this->info("Distances calculated and saved in distances.csv in path: {$data['csvPath']}");
        return Command::SUCCESS;
    }
}
