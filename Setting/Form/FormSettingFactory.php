<?php

namespace Grr\Core\Setting\Form;

use Grr\Core\Setting\General\CompanyNameSetting;
use Grr\Core\Setting\Repository\SettingProvider;
use Grr\Core\Setting\SettingConstants;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_locator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormSettingFactory
{
    /**
     * @var SettingProvider
     */
    private $settingProvider;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var ContainerInterface
     */
    private $criteria;

    public function __construct(SettingProvider $settingProvider, FormFactoryInterface $formFactory, ContainerInterface $criteria)
    {
        $this->settingProvider = $settingProvider;
        $this->formFactory = $formFactory;
        $this->criteria = $criteria;
    }

    public function generate(): FormInterface
    {
        $interfaces = $this->settingProvider->loadAllInterface();
        $settings = $this->sort($interfaces);
        $data = $this->loadValues($interfaces);

        $form = $this->formFactory->createNamedBuilder(
            'setting',
            'Symfony\Component\Form\Extension\Core\Type\FormType',
            $data
        )->getForm();

        foreach ($settings as $setting) {
            $setting->addFieldForm($form);
        }

        return $form;
    }

    private function loadValues(\Traversable $settings): array
    {
        $data = [];


        foreach ($settings as $setting) {

            $data[$setting->name()] = $setting->value();
        }

        return $data;
    }

    private function sort(\Traversable $settings)
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
