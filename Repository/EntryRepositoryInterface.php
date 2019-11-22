<?php

namespace Grr\Core\Repository;

use Carbon\CarbonInterface;
use Grr\Core\Entity\AreaInterface;
use Grr\Core\Entity\EntryInterface;
use Grr\Core\Entity\PeriodicityInterface;
use Grr\Core\Entity\RoomInterface;

interface EntryRepositoryInterface
{
    /**
     * @param AreaInterface|null $area
     *
     * @return EntryInterface[] Returns an array of EntryInterface objects
     */
    public function findForMonth(\DateTimeInterface $date, AreaInterface $area, RoomInterface $room = null): array;

    /**
     * @return EntryInterface[]
     */
    public function findForDay(CarbonInterface $day, RoomInterface $room): array;

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
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getBaseEntryForPeriodicity(PeriodicityInterface $periodicity);

    public function findPeriodicityEntry(EntryInterface $entry): ?EntryInterface;
}
