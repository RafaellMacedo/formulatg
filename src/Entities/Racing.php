<?php

namespace Formulatg\Entities;

use phpDocumentor\Reflection\Types\Integer;

/**
 * @Entity
*/
final class Racing {

    /**
     * @Id
     * @GeneratedValue
     * $Column(type="integer")
    */
    private Integer $id;

    /**
     * @Column(type="boolean")
    */
    public Boolean $status;

    /**
     * @Column(type="string")
     */
    public String $name;

    /**
     * @return String
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void {
        $this->status = $status;
    }
}
