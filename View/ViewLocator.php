<?php

namespace Grr\Core\View;

use Exception;
use Grr\Core\Contrat\Front\ViewInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Traversable;

class ViewLocator
{
    private Traversable $renders;
    private ServiceLocator $serviceLocator;

    public function __construct(
        Traversable $renders,
        ServiceLocator $serviceLocator
    ) {
        $this->renders = $renders;
        $this->serviceLocator = $serviceLocator;
    }

    public function loadAllInterface(): Traversable
    {
        return $this->renders;
    }

    /**
     * @throws Exception
     */
    public function findViewerByView(string $key): ViewInterface
    {
        if ($this->serviceLocator->get($key)) {
            return $this->serviceLocator->get($key);
        }
        throw new Exception('No class found for this vue ' . $key);
    }
}
