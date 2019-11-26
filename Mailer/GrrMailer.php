<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 18/10/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Mailer;

use Grr\GrrBundle\Mailer\EmailFactory;
use Knp\Message\Pdf;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class GrrMailer
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var Pdf
     */
    private $pdf;

    public function __construct(MailerInterface $mailer, Environment $twig, Pdf $pdf)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->pdf = $pdf;
    }

    public function sendWelcome(string $email): TemplatedEmail
    {
        $message = EmailFactory::createNewTemplated();
        $message
            ->to($email)
            ->from('jf@marche.be')
            ->subject('test')
            ->htmlTemplate('email/welcome.html.twig')
            ->context(
                [
                    'zeze' => 'lolo',
                ]
            );
        $this->send($message);

        return $message;
    }

    public function sendTest(): TemplatedEmail
    {
        $html = $this->twig->render(
            'pdf/test.html.twig',
            [

            ]
        );
        $pdf = $this->pdf->getOutputFromHtml($html);

        $message = (EmailFactory::createNewTemplated())
            ->to(new Address('jf@marche.be', 'zeze'))
            ->subject('Your weekly report on the Space Bar!')
            ->htmlTemplate('email/welcome2.html.twig')
            ->context(
                [
                    'zeze' => 'jf',
                ]
            )
            ->attach($pdf, sprintf('weekly-report-%s.pdf', date('Y-m-d')));

        $this->send($message);

        return $message;

    }

    public function send(Email $email): void
    {
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            var_dump($e->getMessage());
        }
    }

    public function t()
    {
        $email = (new NotificationEmail())
            ->from('fabien@marche.be')
            ->to('jf@marche.be')
            ->cc('jfsenechal@gmail.com')
            ->subject('My first notification email via Symfony')
            ->markdown(
                <<<EOF
There is a **problem** on your website, you should investigate it right now.
Or just wait, the problem might solves itself automatically, we never know.
EOF
            )
            ->action('More info2?', 'https://example.com/');
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dump($e->getMessage());
        }
    }

}
