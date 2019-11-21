<?php

namespace Grr\Core\Modules;

interface GrrModuleSenderInterface
{
    public function addModule(GrrModuleInterface $grrModule);

    public function postContent();
}
