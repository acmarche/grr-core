<?php

namespace Grr\Core\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Pour l'activer dans config/services.yaml :
 * Grr\Core\Doctrine\TablePrefix:
 *  arguments:
 *    $prefix: '%env(string:DATABASE_PREFIX)%'
 *  tags:
 *    - { name: doctrine.event_subscriber, connection: default }.
 *
 * Class TablePrefix
 */
class TablePrefix implements EventSubscriber
{
    public function __construct(
        protected string $prefix = 'grr_'
    ) {
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return ['loadClassMetadata'];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();

        if (! $classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName(
            ) === $classMetadata->rootEntityName) {
            $classMetadata->setPrimaryTable(
                [
                    'name' => $this->prefix.$classMetadata->getTableName(),
                ]
            );
        }

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if (ClassMetadataInfo::MANY_TO_MANY == $mapping['type'] && $mapping['isOwningSide']) {
                $mappedTableName = $mapping['joinTable']['name'];
                $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix.$mappedTableName;
            }
        }
    }
}
