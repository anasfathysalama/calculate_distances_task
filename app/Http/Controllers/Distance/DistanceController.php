<?php

namespace App\Http\Controllers\Distance;

use App\Http\Controllers\Controller;
use App\Services\AddressService;
use App\Services\CsvService;
use App\Services\GeoLocationService;
use Illuminate\Http\Request;
use League\Csv\Writer;

class DistanceController extends Controller
{

    protected GeoLocationService $locationService;
    protected AddressService $addressService;

    public function __construct(GeoLocationService $locationService, AddressService $addressService)
    {
        $this->locationService = $locationService;
        $this->addressService = $addressService;
    }

    /**
     * @return string
     */
    public function calcGeolocationDistances(): string
    {
        try {
            $data = $this->locationService->calcGeolocationDistances();
            $this->addressService->outputAddresses($data['addressesLocation']);
            return "Distances calculated and saved in distances.csv in path: {$data['csvPath']}";
        } catch (\Exception $exception) {
            return "Error: {$exception->getMessage()} \n File: {$exception->getFile()} \n Line: {$exception->getLine()}";
        }
    }

}
