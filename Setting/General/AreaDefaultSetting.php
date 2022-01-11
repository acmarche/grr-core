<?php

namespace Grr\Core\Setting\General;

use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Repository\AreaRepositoryInterface;
use Grr\Core\Setting\SettingConstants;
use Grr\Core\Setting\Traits\SettingTrait;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

class AreaDefaultSetting implements SettingGeneralInterface
{
    use SettingTrait;

    public const NAME = SettingConstants::AREA_DEFAULT;

    public function __construct(
        private AreaRepositoryInterface $areaRepository
    ) {
    }

    public function label(): string
    {
        return 'label.setting.area_default';
    }

    public function help(): string
    {
        return 'help.setting.area_default';
    }

    public function value(): ?AreaInterface
    {
        if ($setting = $this->settingRepository->getSettingByName(self::NAME)) {
            $areaId = (int) $setting->getValue();

            return $this->areaRepository->find($areaId);
        }

        return $this->defaultValue();
    }

    public function defaultValue(): ?AreaInterface
    {
        return null;
    }

    public function bindValue($value): ?string
    {
        if ($value instanceof AreaInterface) {
            return (string) $value->getId();
        }

        return null;
    }

    public function isRequired(): bool
    {
        return false;
    }

    public function addFieldForm(FormInterface $form): void
    {
        $form->add(
            self::NAME,
            ChoiceType::class,
            [
                'choices' => $this->areaRepository->findAll(),
                'required' => $this->isRequired(),
                'label' => $this->label(),
                'help' => $this->help(),
                'choice_label' => 'name',
                'choice_value' => 'id',
            ]
        );
    }

    public function displayOrder(): int
    {
        return 10;
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
