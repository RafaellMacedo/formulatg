<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Util\RacingEnum;

class RacingRepository {

    protected EntityRepository $racingRepository;

    /** @throws Exception */
    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->racingRepository = $this->entityManager->getRepository(Racing::class);
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->racingRepository->findAll();
    }

    public function beginRacing($nameRacing): string {
        $findRacingBegin = [
            'status' => RacingEnum::INICIADO
        ];

        if($racing = $this->racingRepository->findOneBy($findRacingBegin)){
            return "\nJá existe uma corrida iniciada, finalize {$racing->getName()}\n\n";
        }

        $racing = $this->racingRepository->findOneBy([
            'name' => $nameRacing
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::INICIADO);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();

            return "\nCorrida {$nameRacing} Iniciada\n\n";
        }

        return "\nCorrida {$nameRacing} Não Encontrada\n\n";
    }

    public function pauseRacing($nameRacing): void {
        $racing = $this->racingRepository->findOneBy([
            'name' => $nameRacing
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::PAUSADO);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
        }
    }

    /**
     * @return Racing
    */
    public function fromArgvToFields($argv): Racing {
        $racing = new Racing();
        $racing->setName($argv[3]);
        $racing->setStatus(1);
        return $racing;
    }

    /**
     * @param Racing $racing
     * @throws \Exception
     */
    public function create(Racing $racing): void {
        $this->entityManager->persist($racing);
        $this->entityManager->flush();
    }
}