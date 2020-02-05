<?php

namespace Grr\Core\Contrat\Repository;

interface SettingRepositoryInterface
{
    public function getValueByName(string $name): ?string;
    public function load(): array;
}
