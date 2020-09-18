<?php


namespace Grr\Core\Setting\General;

use Grr\GrrBundle\Setting\Repository\SettingRepository;
use Twig\Environment;

abstract class AbstractSettingGeneral implements SettingGeneralInterface
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;
    /**
     * @var Environment
     */
    protected $environment;

    public function __construct(SettingRepository $settingRepository, Environment $environment)
    {
        $this->settingRepository = $settingRepository;
        $this->environment = $environment;
    }


}
