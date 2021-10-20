<?php

namespace Formulatg\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Formulatg\Util\RacingEnum;

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
    private int $id;

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

//    /**
//     * @OneToMany(targetEntity="Car", mappedBy="cars")
//    */
//    private ArrayCollection $cars;

//    public function __construct() {
//        $this->cars = new ArrayCollection();
//    }

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

//    public function addCar(Car $car): void {
//        $this->cars->add($car);
//        $car->racing->setRacing($this);
//    }
//
//    public function getCars(): Collection {
//        return $this->cars;
//    }
}
