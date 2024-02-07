<?php

namespace Grr\Core\I18n;

use Symfony\Component\HttpFoundation\Request;
use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;

class LocalHelper
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
        private readonly Security $security,
        private readonly RequestStack $requestStack
    ) {
    }

    public function getDefaultLocal(): string
    {
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
        if ($request instanceof Request) {
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
