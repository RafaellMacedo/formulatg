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

//    /**
//     * @ManyToOne(targetEntity="Racing")
//    */
//    public Racing $racing;

    public function getId(): int {
        return $this->id;
    }

    public function setNameDriver(string $name_driver) {
        $this->name_driver = $name_driver;
    }

    public function getNameDriver(): string {
        return $this->name_driver;
    }

    public function setColor(string $color) {
        $this->color = $color;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function setNumber(int $number) {
        $this->number = $number;
    }

    public function getNumber(): ?int {
        return $this->number ?? null;
    }

    public function setPosition(int $position) {
        $this->position = $position;
    }

    public function getPosition(): ?int {
        return $this->position ?? null;
    }

    public function setStatus(int $status) {
        $this->status = $status;
    }

    public function getStatus(): string {
        return $this->status ? 'Ativo' : 'Inativo';
    }

//    public function setRacing(Racing $racing): void {
//        $this->racing = $racing;
//    }
//
//    public function getRacing(): Racing {
//        return $this->racing;
//    }
}
