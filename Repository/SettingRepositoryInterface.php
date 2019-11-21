<?php

namespace Grr\Core\Repository;

interface SettingRepositoryInterface
{
    public function getValueByName(string $name): ?string;
    public function load(): array;
}
