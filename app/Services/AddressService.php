<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressService
{
    /**
     * @return array
     */
    public function getHeadQuarters(): array
    {
        return [
            [
                "address" => "Adchieve HQ - Sint Janssingel 92, 5211 DA 's-Hertogenbosch, The Netherlands",
                "lat" => 51.688110,
                "lng" => 51.688110
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function getAddresses(): array
    {
        return [
            [
                'name' => 'Eastern Enterprise B.V.',
                'address' => 'Deldenerstraat 70, 7551AH Hengelo, The Netherlands'
            ],
            [
                'name' => 'Eastern Enterprise',
                'address' => '46/1 Office no 1 Ground Floor , Dada House , Inside dada silk mills compound, Udhana Main Rd, near Chhaydo Hospital, Surat, 394210, India'
            ],
            [
                'name' => 'Adchieve Rotterdam',
                'address' => 'Weena 505, 3013 AL Rotterdam, The Netherlands'
            ],
            [
                'name' => 'Sherlock Holmes',
                'address' => '221B Baker St., London, United Kingdom'
            ],
            [
                'name' => 'The White House',
                'address' => '1600 Pennsylvania Avenue, Washington, D.C., USA'
            ],
            [
                'name' => 'The Empire State Building',
                'address' => '350 Fifth Avenue, New York City, NY 10118'
            ],
            [
                'name' => 'The Pope',
                'address' => 'Saint Martha House, 00120 Citta del Vaticano, Vatican City'
            ],
            [
                'name' => 'Neverland',
                'address' => '5225 Figueroa Mountain Road, Los Olivos, Calif. 93441, USA'
            ]

        ];
    }

    /**
     * @param $addressesLocation
     * @return void
     */
    public function outputAddresses($addressesLocation): void
    {
        foreach ($addressesLocation as $location) {
            echo "{$location['Sortnumber']},{$location['Distance']},{$location['Name']},{$location['Address']}";
            echo "<br>";
        }
    }
}
