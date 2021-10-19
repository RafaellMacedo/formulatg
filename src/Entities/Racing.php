<?php

namespace Formulatg\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @Column(type="boolean")
    */
    public Boolean $status;

    /**
     * @Column(type="string")
     */
    public String $name;

    /**
     * @OneToMany(targetEntity="Car", mappedBy="cars")
    */
    private ArrayCollection $cars;

    public function __construct() {
        $this->cars = new ArrayCollection();
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function isStatus(): bool {
        return $this->status;
    }

    public function setStatus(bool $status): void {
        $this->status = $status;
    }

    public function addCar(Car $car): void {
        $this->cars->add($car);
        $car->racing->setRacing($this);
    }

    public function getCars(): Collection {
        return $this->cars;
    }
}
