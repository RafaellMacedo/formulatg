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

    public function getCars() {
        return $this->cars;
    }

    public function getCarsOrderPosition() {
        $carsOrderPosition = $this->cars;
        /** @var Car $car */
        foreach ($this->cars AS $car){
            $carsOrderPosition[$car->getPosition()] = $car;
        }

        $carsOrderPosition->removeElement($carsOrderPosition->first());

        return $carsOrderPosition;
    }

    public function countCars(): int {
        return $this->cars->count();
    }

    public function existPosition($newPosition): bool {
        /** @var Car $car */
        foreach ($this->cars AS $car) {
            if($car->getPosition() == $newPosition){
                return true;
            }
        }
        return false;
    }

    public function existCar(Car $searchCar): bool {
        foreach ($this->cars AS $car) {
            if($car->getId() == $searchCar->getId()){
                return true;
            }
        }
        return false;
    }

    public function isStarted(): bool {
        return $this->status == RacingEnum::STARTED;
    }

    public function isFinished(): bool {
        return $this->status == RacingEnum::FINISHED;
    }
}
