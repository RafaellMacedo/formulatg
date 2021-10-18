<?php

namespace Formulatg\Entities;

/**
 * @Entity
 * @Table(name="cars",
 *     uniqueConstraints={ @UniqueConstraint(name="name_driver_unique", columns={"name_driver"}) }
 * )
 */
final class Car {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected int $id;

    /** @Column(type="string") */
    public string $name_driver;

    /** @Column(type="string") */
    public string $color;

    /** @Column(type="integer") */
    public int $number;

    /** @Column(type="integer", nullable=true) */
    public int $position;

    /** @Column(type="integer") */
    public int $status;

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameDriver(): string {
        return $this->name_driver;
    }

    /**
     * @param string $name_driver
     */
    public function setNameDriver(string $name_driver) {
        $this->nameDriver = $name_driver;
    }

    /**
     * @return string
     */
    public function getColor(): string {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color) {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getNumber(): int {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number) {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getPosition(): int {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position) {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getStatus(): int {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status) {
        $this->status = $status;
    }
}
