<?php

namespace Grr\Core\Contrat\Modules;

interface GrrModuleInterface
{
    public function getName(): string;

    public function getVersion(): string;

    public function doSomething();
}
