<?php

namespace Formulatg\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Formulatg\Util\RacingEnum;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @Entity
 * @Table(name="racing")
*/
final class Racing {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
    */
    protected int $id;

    /**
     * @Column(type="integer")
    */
    public int $status;

    /**
     * @Column(type="string")
     */
    public String $name;

    public function getId(): int {
        return $this->id;
    }
//, cascade={"remove", "persist"}
    /**
     * @ManyToMany(targetEntity="Car", inversedBy="racing")
    */
    private $cars;

    public function __construct() {
        $this->cars = new ArrayCollection();
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function isStatus(): string {
        return RacingEnum::STATUS[$this->status];
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function addCar(Car $car): void {
        $this->cars->add($car);
        $car->addRacing($this);
    }

    public function deleteCar(Car $car): void {
        $this->cars->removeElement($car);
        $car->deleteRacing($this);
    }

    public function getRacingCar(): ArrayCollection {
        return $this->cars;
    }

    public function isStarted(): bool {
        return $this->status == RacingEnum::INICIADO;
    }
}
