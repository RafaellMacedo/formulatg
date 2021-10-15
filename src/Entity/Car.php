<?php

namespace Formulatg\Entity;

/**
 * @Entity
 * @Table(name="cars")
 */
final class Car {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected int $id;

    /** @column(type="string") */
    public string $name_driver;

    /** @column(type="string") */
    public string $color;

    /** @column(type="integer") */
    public int $number;

    /** @column(type="integer", nullable=true) */
    public int $position;

    /** @column(type="integer") */
    public int $status;

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
        $this->name_driver = $name_driver;
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
