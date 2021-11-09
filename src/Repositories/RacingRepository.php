<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Util\Message;
use Formulatg\Util\RacingEnum;

class RacingRepository {

    protected EntityRepository $racingRepository;

    /**
     * @var Message
    */
    private $message;

    /**
     * @var EntityRepository $racingRepository
     */
    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->racingRepository = $this->entityManager->getRepository(Racing::class);

        $this->message = new Message();
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->racingRepository->findAll();
    }

    public function findByName(String $name): Racing {
        return $this->racingRepository->findOneBy([
            'name' => $name
        ]);
    }

    public function showRacingAll(): void {
        $racingList = $this->findAll();

        if(!$racingList) {
            echo $this->message->racingEmpty();
            exit;
        }

        foreach ($racingList as $key => $racing) {
            echo "\nId: {$racing->getId()}\n" .
                "Corrida: {$racing->getName()}\n".
                "Status: {$racing->isStatus()}\n\n";
        }
    }

    public function isInvalid(Racing $racing): bool {
        if($racing->getRacingCar()->count() <= 1) {
            return true;
        }
        return false;
    }

    public function existPilotInvalid(Racing $racing): bool {
        $positionsEmpty = $racing->getRacingCar()
            ->map(function(Car $car) {
               if($car->getPosition() === 0) {
                   return 'empty';
               }
               return $car->getPosition();
            })->toArray();

        if(in_array('empty', $positionsEmpty)) {
            return true;
        }
        return false;
    }

    /**
     * @var Racing $racing
    */
    public function startRacing($racingName): void {
        $findRacingBegin = [
            'status' => RacingEnum::STARTED
        ];

        if($racing = $this->racingRepository->findOneBy($findRacingBegin)){
            echo $this->message->existRacingStarted($racing->getName());
            exit;
        }

        $racing = $this->findByName($racingName);

        if($racing) {
            if($racing->isFinished()){
                echo $this->message->racingFinishedAndNotStart();
                exit;
            }

            if($this->isInvalid($racing)){
                echo $this->message->racingFewPilots();
                exit;
            }

            if($this->existPilotInvalid($racing)){
                echo $this->message->existPilotWithoutPosition();
                exit;
            }

            $racing->setStatus(RacingEnum::STARTED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
            echo $this->message->racingStart($racing->getName());
            exit;
        }

        echo $this->message->racingNotFound($racingName);
    }

    public function pauseRacing($racingName): void {
        $racing = $this->racingRepository->findOneBy([
            'name' => $racingName
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::PAUSED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
            echo $this->message->racingPaused();
            exit;
        }

        echo $this->message->racingNotFound($racingName);
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
        echo $this->message->racingCreate();
    }

    public function finish(String $racingName): void {
        $racing = $this->findByName($racingName);

        if($racing){
            if(!$racing->isStarted()){
                echo $this->message->racingNotCanFinished();
                exit;
            }

            $racing->setStatus(RacingEnum::FINISHED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
            exit;
        }

        echo $this->message->racingNotFound($racingName);
    }
}