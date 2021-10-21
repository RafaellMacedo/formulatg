<?php

namespace Formulatg\Entities;

/**
 * @Entity
 * @table(name="history_racing")
*/
class HistoryRacing {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private int $id;

    /** @column(type="integer") */
    public int $carExceed;

    /** @column(type="string") */
    public string $positionCarExceed;

    /** @column(type="integer") */
    public int $carOverpast;

    /** @column(type="string") */
    public string $positionCarOverpast;

    public function getId(): int {
        return $this->id;
    }

    public function getCarExceed(): int {
        return $this->carExceed;
    }

    public function setCarExceed(int $carExceed): void {
        $this->carExceed = $carExceed;
    }

    public function getPositionCarExceed(): string {
        return $this->positionCarExceed;
    }

    public function setPositionCarExceed(string $positionCarExceed): void {
        $this->positionCarExceed = $positionCarExceed;
    }

    public function getCarOverpast(): int {
        return $this->carOverpast;
    }

    public function setCarOverpast(int $carOverpast): void {
        $this->carOverpast = $carOverpast;
    }

    public function getPositionCarOverpast(): string {
        return $this->positionCarOverpast;
    }

    public function setPositionCarOverpast(string $positionCarOverpast): void {
        $this->positionCarOverpast = $positionCarOverpast;
    }
}
