<?php

namespace Grr\Core\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsDoctrineListener('loadClassMetadata')]
class TablePrefix
{
    public function __construct(
        #[Autowire('%env(string:DATABASE_PREFIX)%')]
        protected ?string $prefix = null
    ) {
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        if ($this->prefix) {
            $classMetadata = $eventArgs->getClassMetadata();
            if (!$classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName(
                ) === $classMetadata->rootEntityName) {
                $classMetadata->setPrimaryTable([
                    'name' => $this->prefix.$classMetadata->getTableName(),
                ]);
            }
            foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
                if ($mapping['type'] == ClassMetadata::MANY_TO_MANY && $mapping['isOwningSide']) {
                    $mappedTableName = $mapping['joinTable']['name'];
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix.$mappedTableName;
                }
            }
        }
    }
}
