## Overview

You have been hired by a company that builds a mobile app for coffee addicts.  You are 
responsible for taking the user’s location and returning a list of the three closest coffee shops.

## Input

The coffee shop list is a comma separated file with rows of the following form:
`Name,Y Coordinate,X Coordinate`

The quality of data in this list of coffee shops may vary.  Malformed entries should cause the 
program to exit appropriately. 

Your program will be executed directly from the command line and will be provided three 
arguments in the following order:
`<user x coordinate> <user y coordinate> <shop data url>`

Notice that the data file will be read from an network location (ex: https://raw.githubusercontent.com/Agilefreaks/test_oop/master/coffee_shops.csv)

## Output

Write a program that takes the user’s coordinates encoded as listed above and prints out a 
newline­separated list of the three closest coffee shops (including distance from the user) in 
order of closest to farthest.  These distances should be rounded to four decimal places. 

Assume all coordinates lie on a plane.

## Example

Using the [coffee_shops.csv](coffee_shops.csv)

__Input__

`47.6 -122.4 coffee_shops.csv`

__Expected output__

```
Starbucks Seattle2,0.0645
Starbucks Seattle,0.0861
Starbucks SF,10.0793
```

## Setup your local environment
* Download the php8 version from https://www.php.net/downloads
* Enable the minimum extension like ```curl and openssl```
* Add cacert.pem by opening http://curl.haxx.se/ca/cacert.pem
* Copy the entire page and save it as a “cacert.pem”
* Open your php.ini file and insert or update the following line.
  ```curl.cainfo = "[pathtofile]cacert.pem"```
* Download your composer from ```https://getcomposer.org/download/```
* Add you env variables in .env. See .env.example to create your .env file and fill it.
* Run ```composer install```
* Create ```storage/log/weather.log``` folder

## Run your application
* Run ```php coffee_shop.php 47.6 -122.4 coffee_shops.csv``` to see the expected output.

## You can use also google APIs to calculate the distance between 2 points
* e.g: ```https://cloud.google.com/blog/products/maps-platform/how-calculate-distances-map-maps-javascript-api```
* I don't implement some unit tests because you don't ask this. Also, any issues of performance are not taking into 
* consideration because you don't specify how many data you'll have in the Excel file.
* The solution is without using an external service because is not free to use it and creating an api key needs a paid
* account.
