<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;

class SendAlwaysEmailToCreatorSetting implements SettingGeneralInterface
{
    use SettingTrait;

    const NAME = SettingConstants::SEND_ALWAYS_MAIL_TO_CREATOR;

    public function label(): string
    {
        return 'label.setting.send_always_mail_to_creator';
    }

    public function help(): string
    {
        return 'help.setting.send_always_mail_to_creator';
    }

    public function value(): bool
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            return (bool)$setting->getValue();
        }

        return $this->defaultValue();
    }

    public function defaultValue(): bool
    {
        return false;
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
            '@grr_admin/setting/_detail.html.twig',
            [
                'setting' => $this,
            ]
        );
    }
}
