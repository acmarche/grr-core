<?php

namespace Grr\Core\I18n;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\Service\Attribute\Required;

trait LocalHelperTrait
{
    /**
     * @var ParameterBagInterface
     */
    #[Required]
    public $parameterBag;
    /**
     * @var RequestStack
     */
    #[Required]
    public $requestStack;
    /**
     * @var Security
     */
    #[Required]
    public $security;

    #[Required]
    public function setParameterBag(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getDefaultLocal(): string
    {
        //dump($this->parameterBag);
        //TranslatorInterface::getLocale
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
