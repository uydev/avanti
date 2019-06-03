<?php
//declare(strict_types=1);
require_once '../App/Classes/Satellite.php';
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use App\Classes\Satellite;
use GuzzleHttp\Exception\GuzzleException;


final class AvantiTest extends TestCase
{
    /**
     * AvantiTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => 'https://api.wheretheiss.at',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function testListSatellites() {

        $satellite = new Satellite();
        $expected = '[{"name":"iss","id":25544}]';
        $actual = $satellite->listSatellites();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws GuzzleException
     */
    public function testgetSatelliteReport() {
        $id = '25544';
        $satellite = new Satellite();
        $report = $satellite->getSatelliteReport($id);

        //        $expected = '{"name":"iss","id":25544,"latitude":-16.091883124312,"longitude":126.33191098121,"altitude":422.63302884837,"velocity":27558.91768852,"visibility":"eclipsed","footprint":4520.8349443421,"timestamp":1559578394,"daynum":2458638.1758565,"solar_lat":22.331800284603,"solar_lon":296.23485012028,"units":"kilometers"}';
        //        $this->assertEquals($expected, $report);

        $actual =  get_object_vars(json_decode($report));

        $this->assertArrayHasKey('latitude',  $actual);
        $this->assertArrayHasKey('longitude',  $actual);
        $this->assertArrayHasKey('altitude', $actual);
        $this->assertArrayHasKey('velocity', $actual);
        $this->assertArrayHasKey('visibility',  $actual);
        $this->assertArrayHasKey('footprint', $actual);
        $this->assertArrayHasKey('timestamp', $actual);
        $this->assertArrayHasKey('daynum',  $actual);
        $this->assertArrayHasKey('solar_lat', $actual);
        $this->assertArrayHasKey('solar_lon', $actual);
        $this->assertArrayHasKey('units', $actual);
    }

    /**
     * @throws GuzzleException
     */
//    public function testgetSatellitePositions() {
//        $id = '25544';
//        $timestamps = time();
//        $satellite = new Satellite();
//        $expected = '{"name":"iss","id":25544,"latitude":-16.091883124312,"longitude":126.33191098121,"altitude":422.63302884837,"velocity":27558.91768852,"visibility":"eclipsed","footprint":4520.8349443421,"timestamp":1559578394,"daynum":2458638.1758565,"solar_lat":22.331800284603,"solar_lon":296.23485012028,"units":"kilometers"}';
//        $actual = $satellite->getSatellitePositions($id, $timestamps);
//        $this->assertEquals($expected, $actual);
//    }

    /**
     * @throws GuzzleException
     */
//    public function testDistanceBetweenCoordinates() {
//        $id = '25544';
//        $timestamps = time();
//        $satellite = new Satellite();
//        $expected = '{"name":"iss","id":25544,"latitude":-16.091883124312,"longitude":126.33191098121,"altitude":422.63302884837,"velocity":27558.91768852,"visibility":"eclipsed","footprint":4520.8349443421,"timestamp":1559578394,"daynum":2458638.1758565,"solar_lat":22.331800284603,"solar_lon":296.23485012028,"units":"kilometers"}';
//        $actual = $satellite->getSatellitePositions($id, $timestamps);
//        $this->assertEquals($expected, $actual);
//    }

}
