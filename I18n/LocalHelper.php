<?php

namespace Grr\Core\I18n;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class LocalHelper
{
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var Security
     */
    private $security;

    public function __construct(ParameterBagInterface $parameterBag, Security $security, RequestStack $requestStack)
    {
        $this->parameterBag = $parameterBag;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    public function getDefaultLocal(): string
    {
        /**
         * User preference.
         *
         * @var UserInterface
         */
        $user = $this->security->getUser();
        if ($user) {
            if ($user->getLanguageDefault()) {
                return $user->getLanguageDefault();
            }
        }
        /**
         * Url.
         */
        $master = $this->requestStack->getMasterRequest();
        if (null !== $master) {
            return $master->getLocale();
        }

        /*
         * Parameter from symfony config/translation.yaml
         * */
        $local = $this->parameterBag->get('kernel.default_locale');
        if ($local != null) {
            return $local;
        }

        return 'fr';//a cause de test phpunit
    }

    public function getSupportedLocales(): array
    {
        $locales = $this->parameterBag->get('grr.supported_locales');

        return array_combine($locales, $locales);
    }
}
