<?php

namespace Grr\Core\Setting\Traits;

use Grr\Core\Contrat\Repository\SettingRepositoryInterface;
use Twig\Environment;

trait SettingTrait
{
    /**
     * @var SettingRepositoryInterface
     */
    protected $settingRepository;
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @required
     */
    public function injectServices(SettingRepositoryInterface $settingRepository, Environment $environment)
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
