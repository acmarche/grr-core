<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 30/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//https://symfony.com/doc/current/session/locale_sticky_session.html
//https://symfony.com/doc/current/translation/locale.html

namespace Grr\Core\I18n;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class UserLocaleSubscriber implements EventSubscriberInterface
{
    public function construct(SessionInterface $session): void
    {
    }
    public function __construct(RequestContext $requestContext)
    {
        $requestContext->getParameter('_locale');
    }
    public static function getSubscribedEvents(): array
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin',
        ];
    }
    public function onInteractiveLogin(): void
    {
    }
    public function onKernelRequest(RequestEvent $requestEvent): void
    {
        $request = $requestEvent->getRequest();
        if ($locale = $request->attributes->get('_locale')) {
            $request->setLocale($locale);
        }
        // some logic to determine the $locale
        $request->setLocale($locale);
    }
}
