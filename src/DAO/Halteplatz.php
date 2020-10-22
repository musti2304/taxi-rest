<?php

namespace App\DAO;

class Halteplatz
{
    private int $id;
    private $name;
    private $auftrag;
    private $einstieg;
    private $wait;
    private array $data;

    /**
     * Halteplatz constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAuftrag()
    {
        return $this->auftrag;
    }

    /**
     * @param $auftrag
     */
    public function setAuftrag($auftrag): void
    {
        $this->auftrag = $auftrag;
    }

    /**
     * @return
     */
    public function getEinstieg()
    {
        return $this->einstieg;
    }

    /**
     * @param $einstieg
     */
    public function setEinstieg($einstieg): void
    {
        $this->einstieg = $einstieg;
    }

    /**
     * @return string
     */
    public function getFahrten(): string
    {
        return (int)$this->getAuftrag() + (int)$this->getEinstieg();
    }

    /**
     * @return string
     */
    public function getWait()
    {
        return $this->wait;
    }

    /**
     * @param $wait
     */
    public function setWait($wait): void
    {
        $this->wait = $wait;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = [
            'auftraege' => $this->getAuftrag(),
            'einstiege' => $this->getEinstieg(),
            'wartezeit' => $this->getWait(),
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function publish(array $data): array
    {
        return $data;
    }
}