<?php

namespace App\Services;

use League\Csv\Writer;

class CsvService
{
    public function createCsv($data)
    {
        $csvPath = storage_path('app/public/distances.csv');
        $csv = Writer::createFromPath($csvPath, 'w+');
        $csv->insertOne(['Sortnumber', 'Distance', 'Name', 'Address']);
        foreach ($data as $result) {
            $csv->insertOne($result);
        }
        return $csvPath;
    }
}
