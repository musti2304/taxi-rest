<?php

namespace App\Service;

use JsonException;

/**
 * Class EinstiegService
 * Service ID = 9
 *
 * @package App\Service
 */
class EinstiegService
{

    /**
     * EinstiegService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $url
     * @return false|string|string[]
     * @throws JsonException
     */
    public function getEinstiege(string $url)
    {
        $data = [];
        $einstiege = file_get_contents($url);

        $einstiege = strip_tags($einstiege);
        $einstiege = str_replace(array('Ä', 'ä', 'Ö', 'ö', 'Ü', 'ü'), array('Ae', 'ae', 'Oe', 'oe', 'Ue', 'ue'), $einstiege);
        $einstiege = substr($einstiege, 2);
        $einstiege = preg_replace('/([\d]+)(&nbsp;)(Einsteiger)(&nbsp;)(ab)(&nbsp;)(\d+:\d+h)/', '', $einstiege);
        $einstiege = substr($einstiege, 1);

        if (preg_match('/(\D|\W)(&nbsp;)(\D+)/', $einstiege)) {
            $einstiege = preg_replace('/(&nbsp;)/', ' ', $einstiege);
            $einstiege = str_replace('nicht am Hp', 'Sonstige', $einstiege);
        }

        if (preg_match_all('/(\d+)(\s)(\D+)/', $einstiege, $matches)) {
            $responseData = [
                'count' => $matches[1],
                'hp' => $matches[3]
            ];
        }

        for ($i = 0, $iMax = count($responseData['count']); $i < $iMax; $i++) {
            $data[] = [
                $responseData['hp'][$i] => $responseData['count'][$i]
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