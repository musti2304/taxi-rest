<?php

namespace App\Service;


use JsonException;

/**
 * Class WartezeitService
 * Service ID = 5
 *
 * @package App\Service
 */
class WartezeitService
{

    /**
     * WartezeitService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $url
     * @return false|string|string[]
     * @throws JsonException
     */
    public function getWartezeit(string $url)
    {
        $data = [];
        $warten = file_get_contents($url);

        $warten = strip_tags($warten);
        $warten = str_replace(array('Ä', 'ä', 'Ö', 'ö', 'Ü', 'ü', '+'), array('Ae', 'ae', 'Oe', 'oe', 'Ue', 'ue', '0:'), $warten);
        $warten = substr($warten, 2);
        $warten = preg_replace('/(&nbsp;)/', ' ', $warten);

        if (preg_match_all('/(\d+:\d+)(\s)(\D+)/', $warten, $matches)) {
            $responseData = [
                'wait' => $matches[1],
                'hp' => $matches[3]
            ];
        }

        for ($i = 0, $iMax = count($responseData['wait']); $i < $iMax; $i++) {
            $data[] = [
                $responseData['hp'][$i] => $responseData['wait'][$i]
            ];
        }

        $data = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        $data = str_replace(['\n', '  \r\r\r', '\/'],['', '', '/'],$data);
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $newData = [];
        foreach ($data as $value) {
            $newData += $value;
        }
        return $newData;
    }
}