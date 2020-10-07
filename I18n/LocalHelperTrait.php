<?php

namespace Grr\Core\I18n;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

trait LocalHelperTrait
{
    /**
     * @var ParameterBagInterface
     * @required
     */
    public $parameterBag;
    /**
     * @var RequestStack
     * @required
     */
    public $requestStack;
    /**
     * @var Security
     * @required
     */
    public $security;

    /**
     * @required
     */
    public function setParameterBag(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getDefaultLocal(): string
    {
        dump($this->parameterBag);
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
        $request = $this->requestStack->getMasterRequest();
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
