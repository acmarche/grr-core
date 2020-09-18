<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormInterface;

class NbCalendarSetting  extends AbstractSettingGeneral
{
    use SettingTrait;

    const NAME = SettingConstants::NB_CALENDAR;

    public function label(): string
    {
        return 'label.setting.nbcalendar';
    }

    public function help(): string
    {
        return 'help.setting.nbcalendar';
    }

    public function value(): int
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            return (bool) $setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): int
    {
        return 1;
    }

    public function isRequired(): bool
    {
        return true;
    }

    public function addFieldForm(FormInterface $form)
    {
        $form->add(
            self::NAME,
            IntegerType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
            ]
        );
    }

    public function displayOrder(): int
    {
        return 5;
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
