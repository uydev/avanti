<?php
#! /usr/bin/php
namespace App\Classes;

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;


class Satellite
{

    /**
     * Satellite constructor.
     */
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://api.wheretheiss.at',
            'timeout' => 2.0,
        ]);
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws GuzzleException
     */
    public function listSatellites()
    {

        $request = new Request('GET', 'https://api.wheretheiss.at/v1/satellites/');
        $response = $this->_client->send($request, ['timeout' => 10]);
        $response = $response->getBody()->getContents();

        return $response;
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws GuzzleException
     */
    public function getSatelliteReport($id)
    {

        $request = new Request('GET', 'https://api.wheretheiss.at/v1/satellites/' . $id);
        $response = $this->_client->send($request, ['timeout' => 10]);
        $response = $response->getBody()->getContents();

        return $response;

    }

    /**
     * @param $id
     * @param $timestamps
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws GuzzleException
     */
    public function getSatellitePositions($id, $timestamps)
    {
        $request = new Request('GET', 'https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps=' . $timestamps . '&units=miles');
        $response = $this->_client->send($request, ['timeout' => 10]);
        $response = $response->getBody()->getContents();

        return $response;
    }

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $latitudeTo
     * @param $longitudeTo
     * @param int $earthRadius
     * @return float|int
     */
    function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}