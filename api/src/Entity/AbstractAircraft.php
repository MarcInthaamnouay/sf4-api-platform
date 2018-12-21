<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 19/12/2018
 * Time: 16:24
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractAircraft
 *
 * @package App\Entity
 */
abstract class AbstractAircraft
{
    /**
     * @var string
     *
     * @ORM\Column(name="passenger", type="integer")
     */
    protected $passenger;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255)
     */
    protected $owner;

    /**
     * AbstractAircraft constructor.
     *
     * @param int $passenger
     * @param string $owner
     */
    public function __construct(
        int $passenger,
        string $owner
    ) {
        $this->passenger = $passenger;
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getPassenger(): string
    {
        return $this->passenger;
    }

    /**
     * @param string $passenger
     */
    public function setPassenger(string $passenger): void
    {
        $this->passenger = $passenger;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }
}