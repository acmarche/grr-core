<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 24/09/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Password;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHelper
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordEncoder
    ) {
    }

    public function encodePassword(UserInterface $user, string $clearPassword): string
    {
        return $this->userPasswordEncoder->hashPassword($user, $clearPassword);
    }
}
