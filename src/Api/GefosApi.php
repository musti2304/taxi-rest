<?php
namespace App\Api;
use InvalidArgumentException;
use RuntimeException;

class GefosApi
{

    /**
     * GefosApi constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     * @return string
     */
    public function getServiceUrl(int $id): string
    {
        $config = include '../config/config.php';
        if (empty($config)) {
            throw new RuntimeException('Failed loading config');
        }

        if (empty($id)) {
            throw new InvalidArgumentException('Service is not available');
        }

        return $config['url'].$id.$config['gps'];
    }

}