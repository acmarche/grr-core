<?php

namespace Grr\Core\Setting\Form;

use Grr\Core\Setting\Repository\SettingProvider;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Traversable;

class FormSettingFactory
{
    public function __construct(
        private SettingProvider $settingProvider,
        private FormFactoryInterface $formFactory,
        private ContainerInterface $criteria
    ) {
    }

    public function generate(): FormInterface
    {
        $interfaces = $this->settingProvider->loadAllInterface();
        $settings = $this->sort($interfaces);
        $data = $this->loadValues($interfaces);

        $form = $this->formFactory->createNamedBuilder(
            'setting',
            FormType::class,
            $data
        )->getForm();

        foreach ($settings as $setting) {
            $setting->addFieldForm($form);
        }

        return $form;
    }

    private function loadValues(Traversable $settings): array
    {
        $data = [];

        foreach ($settings as $setting) {
            $data[$setting->name()] = $setting->value();
        }

        return $data;
    }

    private function sort(Traversable $settings): array
    {
        $ordered = iterator_to_array($settings);
        usort(
            $ordered,
            function ($a, $b) {
                if ($a->displayOrder() == $b->displayOrder()) {
                    return 0;
                }

                return $a->displayOrder() < $b->displayOrder() ? -1 : 1;
            }
        );

        return $ordered;
    }
}
