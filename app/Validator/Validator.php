<?php

declare(strict_types=1);

namespace App\Validator;

use Webmozart\Assert\Assert;

class Validator
{
    public static function validateCoordinates(mixed $latitude, mixed $longitude): void
    {
        Assert::numeric($latitude, 'Latitude must be a decimal number!');
        Assert::numeric($longitude, 'Longitude must be a decimal number!');
    }

    public static function validateFile(mixed $filename): void
    {
        Assert::string($filename, 'Filename should not be empty!');
        Assert::minLength($filename, 4, 'Filename should have at least one 4 characters!');
        Assert::file($filename, 'File does not exist!');
    }

    public static function validateLocation(mixed $location): void
    {
        Assert::string($location, 'Location should not be empty!');
    }
}
