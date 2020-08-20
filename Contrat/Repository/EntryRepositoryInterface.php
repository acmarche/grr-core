<?php

namespace Grr\Core\Contrat\Repository;

use Carbon\CarbonInterface;
use DateTimeInterface;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\PeriodicityInterface;
use Grr\Core\Contrat\Entity\RoomInterface;

interface EntryRepositoryInterface
{
    /**
     * @param AreaInterface|null $area
     *
     * @return EntryInterface[] Returns an array of EntryInterface objects
     */
    public function findForMonth(DateTimeInterface $dateTime, AreaInterface $area, RoomInterface $room = null): array;

    /**
     * @return EntryInterface[]
     */
    public function findForDay(CarbonInterface $carbon, RoomInterface $room): array;

    /**
     * @return EntryInterface[]
     */
    public function isBusy(EntryInterface $entry, RoomInterface $room): array;

    /**
     * @return EntryInterface[] Returns an array of EntryInterface objects
     */
    public function search(array $args = []): array;

    /**
     * @return EntryInterface[]
     */
    public function withPeriodicity(): array;

    /**
     * @return EntryInterface[]
     */
    public function findByPeriodicity(PeriodicityInterface $periodicity): array;

    /**
     * Retourne l'entry de base de la repetition.
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getBaseEntryForPeriodicity(PeriodicityInterface $periodicity);

    public function findPeriodicityEntry(EntryInterface $entry): ?EntryInterface;
}
