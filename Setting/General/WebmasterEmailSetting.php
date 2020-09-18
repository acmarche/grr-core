<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormInterface;

class WebmasterEmailSetting extends AbstractSettingGeneral
{
    use SettingTrait;

    const NAME = SettingConstants::WEBMASTER_EMAIL;

    public function label(): string
    {
        return 'label.setting.webmaster_email';
    }

    public function help(): string
    {
        return 'help.setting.webmaster_email';
    }

    public function value(): string
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            return (string) $setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): string
    {
        return 'webmaster@domain.be';
    }

    public function isRequired(): bool
    {
        return true;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            EmailType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
            ]
        );
    }

    public function displayOrder(): int
    {
        return 8;
    }

    public function renderValue(): string
    {
        return $this->environment->render(
            '@grr_admin/setting/_detail.html.twig',
            [
                'setting' => $this,
            ]
        );
    }
}
