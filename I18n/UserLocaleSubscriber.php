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
    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    private $session;

    public function construct(SessionInterface $session)
    {
        $this->session = $session;
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

    public function onInteractiveLogin(InteractiveLoginEvent $event): void
    {
        return;
        $user = $event->getAuthenticationToken()->getUser();

        if (null !== $user->getLocale()) {
            $this->session->set('_locale', $user->getLocale());
        }
        $requestContext->getParameter('_locale');
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if ($locale = $request->attributes->get('_locale')) {
            $request->setLocale($locale);
        }
        // some logic to determine the $locale
        $request->setLocale($locale);
    }
}
