<?php

declare(strict_types=1);

use App\Services\LocationService;
use App\Validator\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

require_once __DIR__ . '/vendor/autoload.php';

array_shift($argv);
[$latitude, $longitude, $filename] = array_merge($argv, [null, null, null]);

try {
    Validator::validateCoordinates($latitude, $longitude);
    Validator::validateFile($filename);
    $locationService = new LocationService(new Csv());
    $locationService->displayLimitedLocations(
        $locationService->getNearestLocations((float)$latitude, (float)$longitude, $filename)
    );
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
    exit;
}
