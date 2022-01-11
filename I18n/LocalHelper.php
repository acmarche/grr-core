<?php

namespace Grr\Core\I18n;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\LocaleAwareInterface;

class LocalHelper
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private Security $security,
        private RequestStack $requestStack,
        private LocaleAwareInterface $localeAware
    ) {
    }

    public function getDefaultLocal(): string
    {
        //todo test
        $this->localeAware->getLocale();
        /**
         * User preference.
         *
         * @var UserInterface
         */
        $user = $this->security->getUser();
        if ($user && $user->getLanguageDefault()) {
            return $user->getLanguageDefault();
        }
        /**
         * Url.
         */
        $request = $this->requestStack->getMainRequest();
        if (null !== $request) {
            return $request->getLocale();
        }

        /*
         * Parameter from symfony config/translation.yaml
         * */
        $local = $this->parameterBag->get('kernel.default_locale');
        if (null != $local) {
            return $local;
        }

        return 'fr'; //a cause de test phpunit
    }

    public function getSupportedLocales(): array
    {
        $locales = $this->parameterBag->get('grr.supported_locales');

        return array_combine($locales, $locales);
    }
}
