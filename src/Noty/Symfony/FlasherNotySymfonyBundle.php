<?php

namespace Flasher\Noty\Symfony;

use Flasher\Noty\Symfony\DependencyInjection\FlasherNotyExtension;
use Flasher\Symfony\Bridge\FlasherBundle;
use Flasher\Symfony\DependencyInjection\Compiler\ResourceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FlasherNotySymfonyBundle extends FlasherBundle
{
    protected function flasherBuild(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ResourceCompilerPass($this->getFlasherContainerExtension()));
    }

    protected function getFlasherContainerExtension()
    {
        return new FlasherNotyExtension();
    }
}
