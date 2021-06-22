<?php

namespace Grr\Core\Setting\General;

use DateTime;
use DateTimeInterface;
use Exception;
use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;

class EndBookingSetting implements SettingGeneralInterface
{
    use SettingTrait;

    public const NAME = SettingConstants::END_BOOKINGS;

    public function label(): string
    {
        return 'label.setting.end_booking';
    }

    public function help(): string
    {
        return 'help.setting.end_booking';
    }

    public function value(): DateTimeInterface
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            try {
                return DateTime::createFromFormat('Y-m-d', $setting->getValue());
            } catch (Exception $exception) {
                return $this->defaultValue();
            }
        }

        return $this->defaultValue();
    }

    public function defaultValue(): DateTimeInterface
    {
        return new DateTime('+5 years');
    }

    public function bindValue($value): ?string
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d');
        }

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
            DateType::class,
            [
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
            ]
        );
    }

    public function displayOrder(): int
    {
        return 3;
    }

    public function renderValue(): string
    {
        return $this->environment->render(
            '@grr_admin/setting/_detail_date.html.twig',
            [
                'setting' => $this,
            ]
        );
    }
}
