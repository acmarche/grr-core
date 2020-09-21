<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class TitleHomePageSetting implements SettingGeneralInterface
{
    use SettingTrait;

    const NAME = SettingConstants::TITLE_HOME_PAGE;

    public function label(): string
    {
        return 'label.setting.title_homepage';
    }

    public function help(): string
    {
        return 'help.setting.title_homepage';
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
        return 'Title home page';
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
