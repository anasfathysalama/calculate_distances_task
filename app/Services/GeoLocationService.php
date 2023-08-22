<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoLocationService
{

    protected AddressService $addressService;
    protected CsvService $csvService;

    public function __construct(AddressService $addressService, CsvService $csvService)
    {
        $this->addressService = $addressService;
        $this->csvService = $csvService;
    }

    /**
     * @return array
     */
    public function calcGeolocationDistances(): array
    {
        $headQuarters = $this->addressService->getHeadQuarters();
        $addresses = $this->addressService->getAddresses();
        $addressesLocation = $this->getAddressesGeolocation($addresses, $headQuarters[0]);
        $csvPath = $this->csvService->createCsv($addressesLocation);
        return [
            'csvPath' => $csvPath,
            'addressesLocation' => $addressesLocation,
        ];
    }


    /**
     * @param $address
     * @return array|null
     */
    private function getAddressGeolocation($address): ?array
    {
        $response = Http::get(config('position_stack.api_url'), [
            'access_key' => config('position_stack.api_key'),
            'query' => $address['address'],
        ]);
        $data = $response->json();
        return isset($data['data'][0]['latitude'], $data['data'][0]['longitude'])
            ? ['lat' => $data['data'][0]['latitude'], 'lng' => $data['data'][0]['longitude']]
            : null;
    }

    /**
     * @param $location1
     * @param $location2
     * @return array
     */
    private function calculateDistance($location1, $location2): array
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        $lat1 = deg2rad($location1['lat']);
        $lng1 = deg2rad($location1['lng']);
        $lat2 = deg2rad($location2['lat']);
        $lng2 = deg2rad($location2['lng']);
        $deltaLat = $lat2 - $lat1;
        $deltaLng = $lng2 - $lng1;
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLng / 2) * sin($deltaLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return [
            'formattedDistance' => number_format($distance, 2) . ' km',
            'distanceInNumber' => round($distance, 2),
        ];
    }


    /**
     * @param array $addresses
     * @param $location2
     * @return array
     *
     */
    private function getAddressesGeolocation(array $addresses, $location2): array
    {
        $data = [];
        foreach ($addresses as $key => $address) {
            $location = $this->getAddressGeolocation($address);
            if ($location) {
                $distance = $this->calculateDistance($location, $location2);
                $data[] = [
                    'Sortnumber' => $key + 1,
                    'Distance' => $distance['formattedDistance'],
                    'distanceInNumber' => $distance['distanceInNumber'],
                    'Name' => $address['name'],
                    'Address' => $address['address'],
                ];
            }
        }
        $data = collect($data)->sortBy('distanceInNumber');
        return array_values($data->toArray());
    }

}
