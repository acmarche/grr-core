<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;

class FullDaySetting
{
    use SettingTrait;

    const NAME = SettingConstants::FULL_DAY;

    public function label(): string
    {
        return 'label.setting.fullday';
    }

    public function help(): string
    {
        return 'help.setting.fullday';
    }

    public function value(): bool
    {
        if ($setting = $this->settingRepository->getSettingByName(SettingConstants::FULL_DAY)) {
            return (bool) $setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): bool
    {
        return true;
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            CheckboxType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
                'label_attr' => [
                    'class' => 'switch-custom',
                ],
            ]
        );
    }

    public function displayOrder(): int
    {
        return 6;
    }

    public function renderValue(): string
    {
        return $this->environment->render(
            '@grr_admin/setting/_detail_boolean.html.twig',
            [
                'setting' => $this,
            ]
        );
    }
}
