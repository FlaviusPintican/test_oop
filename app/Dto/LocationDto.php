<?php

declare(strict_types=1);

namespace App\Dto;

class LocationDto
{
    private string $name;
    private float $latitude;
    private float $longitude;
    private float $distanceFromMyLocation;

    public function __construct(array $location)
    {
        [$this->name, $this->latitude, $this->longitude, $this->distanceFromMyLocation] = $location;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getDistanceFromMyLocation(): float
    {
        return $this->distanceFromMyLocation;
    }
}
