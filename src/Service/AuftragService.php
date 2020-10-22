<?php

namespace App\Service;

use JsonException;

/**
 * Class AuftragService
 * Service ID = 4
 *
 * @package App\Service
 */
class AuftragService
{

    /**
     * AuftragService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $url
     * @return false|string|string[]
     * @throws JsonException
     */
    public function getAuftraege(string $url)
    {
        $data = [];
        $responseData = [];
        $orders = file_get_contents($url);
        $orders = strip_tags($orders);
        $orders = str_replace
        (
            array('Ä', 'ä', 'Ö', 'ö', 'Ü', 'ü', '\n'),
            array('Ae', 'ae', 'Oe', 'oe', 'Ue', 'ue', ''),
            $orders
        );
        $orders = substr($orders, 2);
        $orders = preg_replace
        (
            '/([\d]+)(&nbsp;)(Auftr\.)(&nbsp;)(HP)(&nbsp;)+(\d+:\d+)(-)((&nbsp;)?(\d+:\d+))/',
            '', $orders
        );
        $orders = substr($orders, 1);

        $orders = preg_replace('/(&nbsp;)/', ' ', $orders);
        $orders = preg_replace('/(\n)(\W+)/', '', $orders);

        if (preg_match_all('/(\d+)(\s)(\D+)/', $orders, $matches)) {
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
        $data = str_replace(['\n', '\/'], ['', '/'], $data);
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $newData = [];
        foreach ($data as $value) {
            $newData += $value;
        }
        return $newData;
    }
}