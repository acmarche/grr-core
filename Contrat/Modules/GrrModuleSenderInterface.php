<?php

namespace Grr\Core\Contrat\Modules;

interface GrrModuleSenderInterface
{
    public function addModule(GrrModuleInterface $grrModule);

    public function postContent();
}
