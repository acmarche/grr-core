<?php

namespace Grr\Core\Setting\Traits;

use Grr\Core\Contrat\Repository\SettingRepositoryInterface;
use Symfony\Contracts\Service\Attribute\Required;
use Twig\Environment;

trait SettingTrait
{
    protected SettingRepositoryInterface $settingRepository;

    protected Environment $environment;

    #[Required]
    public function injectServices(SettingRepositoryInterface $settingRepository, Environment $environment): void
    {
        $this->settingRepository = $settingRepository;
        $this->environment = $environment;
    }

    public function name(): string
    {
        return self::NAME;
    }

    public static function getDefaultIndexName(): string
    {
        return self::NAME;
    }

    public function bindValue($value): string
    {
        return (string) $value;
    }
}
