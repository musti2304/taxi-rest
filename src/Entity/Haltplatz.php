<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Haltplatz
 * @package App\Entity
 * @ORM\Table(name="halteplatz")
 * @ORM\Entity()
 */
class Haltplatz
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auftraege", type="string", length=10)
     */
    private $auftraege;

    /**
     * @var string
     *
     * @ORM\Column(name="einstiege", type="string", length=10)
     */
    private $einstiege;

    /**
     * @var string
     *
     * @ORM\Column(name="wartezeit", type="string", length=10)
     */
    private $wartezeit;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuftraege(): string
    {
        return $this->auftraege;
    }

    /**
     * @param string $auftraege
     */
    public function setAuftraege(string $auftraege): void
    {
        $this->auftraege = $auftraege;
    }

    /**
     * @return string
     */
    public function getEinstiege(): string
    {
        return $this->einstiege;
    }

    /**
     * @param string $einstiege
     */
    public function setEinstiege(string $einstiege): void
    {
        $this->einstiege = $einstiege;
    }

    /**
     * @return string
     */
    public function getWartezeit(): string
    {
        return $this->wartezeit;
    }

    /**
     * @param string $wartezeit
     */
    public function setWartezeit(string $wartezeit): void
    {
        $this->wartezeit = $wartezeit;
    }



}