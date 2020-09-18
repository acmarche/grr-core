<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

class DefaultLanguageSetting
{
    use SettingTrait;

    const NAME = SettingConstants::DEFAULT_LANGUAGE;

    public function label(): string
    {
        return 'label.setting.default_language';
    }

    public function help(): string
    {
        return 'label.setting.default_language';
    }

    public function value(): string
    {
        if ($setting = $this->settingRepository->getSettingByName(SettingConstants::DEFAULT_LANGUAGE)) {
            return (string) $setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): string
    {
        return 'fr';
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            ChoiceType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
                'choices' => ['fr' => 'fr'],
            ]
        );
    }

    public function displayOrder(): int
    {
        return 4;
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
