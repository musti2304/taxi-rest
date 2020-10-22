<?php


namespace App\DAO;


class User
{
    protected string $besetzt;
    protected string $gesamt;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getBesetzt(): string
    {
        return $this->besetzt;
    }

    /**
     * @param string $besetzt
     */
    public function setBesetzt(string $besetzt): void
    {
        $this->besetzt = $besetzt;
    }

    /**
     * @return string
     */
    public function getGesamt(): string
    {
        return $this->gesamt;
    }

    /**
     * @param string $gesamt
     */
    public function setGesamt(string $gesamt): void
    {
        $this->gesamt = $gesamt;
    }
}
