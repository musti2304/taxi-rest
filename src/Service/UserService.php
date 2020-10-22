<?php

namespace App\Service;

use App\Api\GefosApi;

/**
 * Class UserService
 * Service ID = 6
 * @package App\Service
 */
class UserService
{
    protected GefosApi $api;
    protected UserService $userService;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->api = new GefosApi();
    }

    public function getData()
    {
        return $this->getUser($this->api->getServiceUrl(6));
    }

    /**
     * @param string $url
     * @return false|string|string[]
     */
    public function getUser(string $url)
    {
        $responseData = [];
        $users = file_get_contents($url);
        $users = strip_tags($users);
        $users = str_replace(array('Ä', 'ä', 'Ö', 'ö', 'Ü', 'ü', '\n'), array('Ae', 'ae', 'Oe', 'oe', 'Ue', 'ue', ''), $users);
        $users = substr($users, 2);
        $users = preg_replace('/(\w+)\s(\d+)\s(HP\d+)(\(\d+%\))/', '', $users);
        $users = preg_replace('/(frei)(\d+)(\(\d+%\))/', '', $users);
        $users = preg_replace('/(zielgemeldet)(\d+)(\(\d+%\))/', '', $users);
        $users = preg_replace('(\(\d+%\))', '', $users);
        $users = substr($users, 3);

        if (preg_match_all('/([a-z]+)(\d+)/', $users, $matches)) {
            $responseData = [
                $matches[1][0] => $matches[2][0],
                $matches[1][1] => $matches[2][1]
            ];
        }
        return $responseData;
    }
}