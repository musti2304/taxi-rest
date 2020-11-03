<?php


namespace App\Service;

use App\Api\GefosApi;
use JsonException;

class HalteplatzService
{

    protected GefosApi $api;
    protected AuftragService $auftragService;
    protected EinstiegService $einstiegService;
    protected WartezeitService $wartezeitService;

    public function __construct()
    {
        $this->api = new GefosApi();
        $this->auftragService = new AuftragService();
        $this->einstiegService = new EinstiegService();
        $this->wartezeitService = new WartezeitService();
    }

    public function getData()
    {
        $data = [];
        try {
            $data = [
                'auftraege' => $this->auftragService->getAuftraege($this->api->getServiceUrl(4)),
                'einstiege' => $this->einstiegService->getEinstiege($this->api->getServiceUrl(9)),
                'wartezeit' => $this->wartezeitService->getWartezeit($this->api->getServiceUrl(5)),

            ];
        } catch (JsonException $e) {
            $e->getMessage();
        }

        return $this->setData($data);
    }

    /**
     * @param array $data
     * @return array|false|string
     */
    public function setData(array $data)
    {

        foreach ($data['auftraege'] as $key => $value) {
            $hp1[$key] = [
                'auftraege' => (int)$value,
            ];
        }

        foreach ($data['einstiege'] as $key => $value) {
            $hp2[$key] = [
                'einstiege' => (int)$value,
            ];
        }

        foreach ($data['wartezeit'] as $key => $value) {
            $hp3[$key] = [
                'wartezeit' => $value,
            ];
        }

        $mergedArray = array_merge_recursive($hp1, $hp2, $hp3);

        for ($i = 0, $iMax = count($mergedArray); $i < $iMax; $i++) {
            $arr[] = [
                'name' => array_keys($mergedArray)[$i],
                'data' => [
                    array_values($mergedArray)[$i]
                ]
            ];
        }
        return [
            'stations' => $arr
        ];
    }

}