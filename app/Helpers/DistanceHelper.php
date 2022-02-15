<?php

declare(strict_types=1);

namespace App\Helpers;

class DistanceHelper
{
    /**
     * Calculates the great-circle distance between two points, withthe Vincenty formula.
     *
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param int $earthRadius Mean earth radius in [m]
     *
     * @return float distance between points in [kilometers] (same as earthRadius)
     */
    public static function vincentyGreatCircleDistanceInKm(
        float $latitudeFrom,
        float $longitudeFrom,
        float $latitudeTo,
        float $longitudeTo,
        int $earthRadius = 6371000
    ): float {
        // convert from degrees to radians
        $latitudeFrom = deg2rad($latitudeFrom);
        $longitudeFrom = deg2rad($longitudeFrom);
        $latitudeTo = deg2rad($latitudeTo);
        $longitudeTo = deg2rad($longitudeTo);

        $longitudeDelta = $longitudeTo - $longitudeFrom;

        $from = pow(cos($latitudeTo) * sin($longitudeDelta), 2)
            + pow(cos($latitudeFrom) * sin($latitudeTo) - sin($latitudeFrom)
            * cos($latitudeTo) * cos($longitudeDelta), 2);

        $to = sin($latitudeFrom) * sin($latitudeTo) + cos($latitudeFrom) * cos($latitudeTo) * cos($longitudeDelta);

        $angle = atan2(sqrt($from), $to);

        return (float)number_format(($angle * $earthRadius) / 1000, 4);
    }
}
