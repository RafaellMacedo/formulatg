<?php

namespace Formulatg\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Collection;

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

    /** @Column(type="string", nullable=false) */
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
     * @ManyToMany(targetEntity="Racing", mappedBy="cars")
    */
    private $racing;

    public function __construct() {
        $this->racing = new ArrayCollection();
    }

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

    public function addRacing(Racing $racing): void {
        $this->racing->add($racing);
    }

    public function deleteRacing(Racing $racing): void {
        $this->racing->removeElement($racing);
    }

    public function getRacing(): Collection {
        return $this->racing;
    }

    public function findRacingNotFinished(): void {
        /** @var Racing $racing */
        foreach ($this->racing AS $racing) {
            if($racing->isStarted()){
                break;
            }
            echo "\n{$racing->getName()} - {$racing->isStatus()}\n\n";
        }
    }

    public function existParticipationRacing(): bool {
        if($this->racing->count() > 0){
            return true;
        }
        return false;
    }

    public function isValid(): bool {
        if(empty($this->getNameDriver()) || empty($this->getColor()) || empty($this->getNumber())) {
            return false;
        }

        return true;
    }
}
