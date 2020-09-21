<?php

namespace Grr\Core\Setting\Repository;

use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Repository\AreaRepositoryInterface;
use Grr\Core\Setting\General\SettingGeneralInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

class SettingProvider
{
    /**
     * @var array
     */
    private $settings;
    /**
     * @var AreaRepositoryInterface
     */
    private $areaRepository;
    /**
     * @var ServiceLocator
     */
    private $criteria;

    public function __construct(
        \Traversable $settings,
        ServiceLocator $criteria,
        AreaRepositoryInterface $areaRepository
    ) {
        $this->settings = $settings;
        $this->areaRepository = $areaRepository;
        $this->criteria = $criteria;
    }

    public function loadAllInterface(): \Traversable
    {
        return $this->settings;
    }

    /**
     * @throws \Exception
     */
    public function loadInterfaceByKey(string $key): SettingGeneralInterface
    {
        if ($this->criteria->get($key)) {
            return $this->criteria->get($key);
        }
        throw new \Exception('Aucune class trouvée pour gérer cette option');
    }

    public function loadData(): array
    {
        $data = [];

        foreach ($this->loadAllInterface() as $setting) {
            $data[$setting->name()] = $setting->value();
        }

        return $data;
    }

    public function renderAll(): string
    {
        $data = '';

        foreach ($this->loadAllInterface() as $setting) {
            $data .= $setting->renderValue();
        }

        return $data;
    }

    /**
     * @todo
     */
    public function getDefaultArea(): ?AreaInterface
    {
        return $this->areaRepository->findOneBy([], ['id' => 'ASC']);
    }

    /**
     * @todo default room
     */
    public function getDefaulRoom(): ?RoomInterface
    {
        return null;
    }
}
