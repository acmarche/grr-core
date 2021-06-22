<?php

namespace Grr\Core\Setting\Repository;

use Exception;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Repository\AreaRepositoryInterface;
use Grr\Core\Setting\General\AreaDefaultSetting;
use Grr\Core\Setting\General\SettingGeneralInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Traversable;

class SettingProvider
{
    private Traversable $settings;
    private AreaRepositoryInterface $areaRepository;
    private ServiceLocator $serviceLocator;

    public function __construct(
        Traversable $settings,
        ServiceLocator $serviceLocator,
        AreaRepositoryInterface $areaRepository
    ) {
        $this->settings = $settings;
        $this->areaRepository = $areaRepository;
        $this->serviceLocator = $serviceLocator;
    }

    public function loadAllInterface(): Traversable
    {
        return $this->settings;
    }

    /**
     * @throws Exception
     */
    public function loadInterfaceByKey(string $key): SettingGeneralInterface
    {
        if ($this->serviceLocator->get($key)) {
            return $this->serviceLocator->get($key);
        }
        throw new Exception('Aucune class trouvée pour gérer cette option');
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
     *
     */
    public function getDefaultArea(): ?AreaInterface
    {
        $interface = $this->loadInterfaceByKey(AreaDefaultSetting::NAME);
        $area = $interface->value();
        if ($area instanceof AreaInterface) {
            return $area;
        }

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
