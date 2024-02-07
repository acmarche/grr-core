<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 23/09/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class PropertyUtil
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function getProperties(string $className): ?array
    {
        $doctrineExtractor = new DoctrineExtractor($this->entityManager);

        return $doctrineExtractor->getProperties($className);
    }

    public function getPropertyAccessor(): PropertyAccessor
    {
        return PropertyAccess::createPropertyAccessor();
    }
}
