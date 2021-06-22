<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;

class MessageHomePageSetting implements SettingGeneralInterface
{
    use SettingTrait;

    public const NAME = SettingConstants::MESSAGE_HOME_PAGE;

    public function label(): string
    {
        return 'label.setting.message_homepage';
    }

    public function help(): string
    {
        return 'help.setting.message_homepage';
    }

    public function value(): ?string
    {
        if ($setting = $this->settingRepository->getSettingByName(SettingConstants::MESSAGE_HOME_PAGE)) {
            return (bool) $setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): ?string
    {
        return null;
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            TextareaType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
            ]
        );
    }

    public function displayOrder(): int
    {
        return 7;
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
