<?php

namespace Grr\Core\Setting\General;

use DateTime;
use DateTimeInterface;
use Exception;
use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;

class BeginBookingSetting implements SettingGeneralInterface
{
    use SettingTrait;

    public const NAME = SettingConstants::BEGIN_BOOKINGS;

    public function label(): string
    {
        return 'label.setting.begin_booking';
    }

    public function help(): string
    {
        return 'help.setting.begin_booking';
    }

    public function value(): bool|\DateTime|\DateTimeInterface
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            try {
                return DateTime::createFromFormat('Y-m-d', $setting->getValue());
            } catch (Exception) {
                return $this->defaultValue();
            }
        }

        return $this->defaultValue();
    }

    public function defaultValue(): \DateTime
    {
        return new DateTime();
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
        return true;
    }

    public function addFieldForm(FormInterface $form): void
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
        return 2;
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
