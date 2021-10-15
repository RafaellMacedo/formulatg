<?php

namespace Api\Entity;

/*
 * */
class Car {

    /*
     * */
    protected int $id;

    public string $name_driver;

    public string $color;

    public int $number;

    public int $position;

    public int $status;

    /**
     * @return string
     */
    public function getNameDriver() {
        return $this->name_driver;
    }

    /**
     * @param string $name_driver
     */
    public function setNameDriver($name_driver) {
        $this->name_driver = $name_driver;
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color) {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number) {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position) {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }
}
