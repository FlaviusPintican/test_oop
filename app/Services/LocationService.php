<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\LocationDto;
use App\Helpers\DistanceHelper;
use App\Validator\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class LocationService
{
    public function __construct(private Csv $csv)
    {
    }

    public function getNearestLocations(float $latitudeFrom, float $longitudeFrom, string $filename): array
    {
        $locations = $this->loadLocations($filename);
        $this->validateLocations($locations);

        $locations = array_map(
            function (array $locationInfo) use ($latitudeFrom, $longitudeFrom): LocationDto {
                [, $latitudeTo, $longitudeTo] = $locationInfo;
                $locationInfo[] = DistanceHelper::vincentyGreatCircleDistanceInKm(
                    $latitudeFrom,
                    $longitudeFrom,
                    $latitudeTo,
                    $longitudeTo
                );

                return new LocationDto($locationInfo);
            },
            $locations
        );

        return $this->getSortedLocations($locations);
    }

    public function displayLimitedLocations(array $locations, int $limit = 3): void
    {
        /** @var LocationDto[] $locations */
        $locations = array_splice($locations, 0, $limit);

        foreach ($locations as $location) {
            echo $location->getName() . ' ' . $location->getDistanceFromMyLocation() . PHP_EOL;
        }
    }

    private function loadLocations(string $filename): array
    {
        $spreadsheet = $this->csv->load($filename);

        return $spreadsheet->getActiveSheet()->toArray();
    }

    private function validateLocations(array $locationList): void
    {
        foreach ($locationList as $locationInfo) {
            [$location, $latitude, $longitude] = array_merge($locationInfo, [null, null, null]);
            Validator::validateCoordinates($latitude, $longitude);
            Validator::validateLocation($location);
        }
    }

    private function getSortedLocations(array $locations): array
    {
        usort(
            $locations,
            function (LocationDto $firstLocation, LocationDto $secondLocation): int {
                return $firstLocation->getDistanceFromMyLocation() <=> $secondLocation->getDistanceFromMyLocation();
            }
        );

        return $locations;
    }
}
