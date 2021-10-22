<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\HistoryRacing;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;

class HistoryRacingRepository {

    protected EntityRepository $historyRacingRepository;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->historyRacingRepository = $this->entityManager->getRepository(HistoryRacing::class);
    }

    public function show(): void {
        $listHistoryRacing =  $this->historyRacingRepository->findAll();

        $carRespository = $this->entityManager->getRepository(Car::class);

        /**
         * @var HistoryRacing $historyRacing
         * @var Car $carExceed
         * @var Car $carOverpast
         */
        foreach ($listHistoryRacing AS $historyRacing) {
            $carExceed = $carRespository->find($historyRacing->getCarExceed());
            $carOverpast = $carRespository->find($historyRacing->getCarOverpast());

            echo "\nO Piloto {$carExceed->getNameDriver()} " .
                "estava na posição {$historyRacing->getPositionCarExceed()} \n" .
                "\tultrapassou o piloto -> {$carOverpast->getNameDriver()} " .
                "que estava na posição " .
                "{$historyRacing->getPositionCarOverpast()} \n\n";

        }
    }

    /** @return Racing */
    public function findRacing(String $racingName): Racing {
        return $this->entityManager
            ->getRepository(Racing::class)
            ->findOneBy([ 'name' => $racingName ]);
    }

    /** @return Car */
    public function findByNameDriver(String $carName): Car {
        /** @var EntityRepository $carRepository */
        $carRepository = $this->entityManager->getRepository(Car::class);
        return $carRepository->findOneBy([ 'name_driver' => $carName ]);
    }

    /** @return Car */
    public function findByPosition(String $carPosition): Car {
        $carRepository = $this->entityManager->getRepository(Car::class);
        return $carRepository->findOneBy([ 'position' => $carPosition ]);
    }

    public function isInvalidExceed(Car $carExceed, Car $carOverpast): bool {
        return ($carExceed->getPosition() - 1) != $carOverpast->getPosition();
    }

    public function createHistory(String $racingName, String $carNameExceed, String $carNameOverpast): void {
        $racing = $this->findRacing($racingName);

        if(!$racing->isStarted()){
            echo "\nCorrida não iniciada!\n\n";
            exit;
        }

        $carExceed = $this->findByNameDriver($carNameExceed);
//echo "\nExceed {$carExceed->getPosition()}\n\n";
        $positionOverpast = $carExceed->getPosition() - 1;

        $carOverpast = $this->findByNameDriver($carNameOverpast);
//echo "\n overpast {$carOverpast->getPosition()}\n\n"; exit;
        if($this->isInvalidExceed($carExceed, $carOverpast)) {
            echo "\nPiloto {$carExceed->getNameDriver()} " .
                "não pode ultrapassar o piloto {$carOverpast->getNameDriver()}\n\n";
            exit;
        }

        $historyRacing = new HistoryRacing();
        $historyRacing->setRacing($racing->getId());
        $historyRacing->setCarExceed($carExceed->getId());
        $historyRacing->setCarOverpast($carOverpast->getId());
        $historyRacing->setPositionCarExceed($carOverpast->getPosition());
        $historyRacing->setPositionCarOverpast($carExceed->getPosition());
        $this->entityManager->persist($historyRacing);

        $carOverpast->setPosition($carExceed->getPosition());
        $carExceed->setPosition($positionOverpast);

        $this->entityManager->persist($carExceed);
        $this->entityManager->persist($carOverpast);

        $this->entityManager->flush();
    }
}