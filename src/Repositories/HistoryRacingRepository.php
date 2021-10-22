<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\HistoryRacing;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Util\Message;

class HistoryRacingRepository {

    protected EntityRepository $historyRacingRepository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->historyRacingRepository = $this->entityManager->getRepository(HistoryRacing::class);
        $this->message = new Message();
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

            echo "\nPiloto {$carExceed->getNameDriver()} " .
                "posição {$historyRacing->getPositionCarOverpast()}\n" .
                "Ultrapassou o piloto {$carOverpast->getNameDriver()} " .
                "da posição " .
                "{$historyRacing->getPositionCarExceed()} \n\n";
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
            $this->message->racingNotStarted();
            exit;
        }

        $carExceed = $this->findByNameDriver($carNameExceed);
        $positionOverpast = $carExceed->getPosition() - 1;
        $carOverpast = $this->findByNameDriver($carNameOverpast);

        if($this->isInvalidExceed($carExceed, $carOverpast)) {
            echo "\nPiloto {$carExceed->getNameDriver()} " .
                "não pode ultrapassar o piloto {$carOverpast->getNameDriver()}\n\n";
            exit;
        }

        $historyRacing = new HistoryRacing();
        $historyRacing->setRacing($racing->getId());
        $historyRacing->setCarExceed($carExceed->getId());
        $historyRacing->setCarOverpast($carOverpast->getId());
        $historyRacing->setPositionCarExceed($carExceed->getPosition());
        $historyRacing->setPositionCarOverpast($carOverpast->getPosition());
        $this->entityManager->persist($historyRacing);

        $carOverpast->setPosition($carExceed->getPosition());
        $carExceed->setPosition($positionOverpast);

        $this->entityManager->persist($carExceed);
        $this->entityManager->persist($carOverpast);

        $this->entityManager->flush();
    }
}