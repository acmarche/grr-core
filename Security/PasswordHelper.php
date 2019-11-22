<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 24/09/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Security;

use Grr\GrrBundle\Entity\Security\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordHelper
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function encodePassword(User $user, string $clearPassword): string
    {
        return $this->userPasswordEncoder->encodePassword($user, $clearPassword);
    }
}
