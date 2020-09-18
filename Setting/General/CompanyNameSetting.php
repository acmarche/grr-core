<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class CompanyNameSetting extends AbstractSettingGeneral
{
    use SettingTrait;

    const NAME = SettingConstants::COMPANY;

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'label.setting.company';
    }

    public function help(): string
    {
        return 'help.setting.compagny';
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
        return 'Company name';
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            TextType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
            ]
        );
    }

    public function displayOrder(): int
    {
        return 1;
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
