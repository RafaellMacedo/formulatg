<?php

namespace Formulatg\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="racing_car")
 */
class RacingCar {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected int $id;

    /**
     * @OneToMany(targetEntity="Car", mappedBy="cars")
    */
    private ArrayCollection $carCollection;

    /**
     * @OneToMany(targetEntity="Racing", mappedBy="racing")
     */
    private ArrayCollection $racingCollection;

    public function __construct() {
        $this->carCollection = new ArrayCollection();
        $this->racingCollection = new ArrayCollection();
    }

    public function addCar(Car $car): void {
        $this->carCollection->add($car);
//        $car->racing->setRacing($this);
    }

    public function getCars(): Collection {
        return $this->carCollection;
    }

    public function addRacing(Racing $racing): void {
        $this->racingCollection->add($racing);
//        $racing->racing->setRacing($this);
    }

    public function getRacing(): Collection {
        return $this->racingCollection;
    }
}