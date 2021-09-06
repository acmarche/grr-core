<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Contrat\Repository\Security;

interface UserRepositoryInterface
{
    public function persist(object $entity);

    public function flush();

    public function remove(object $entity);
}
