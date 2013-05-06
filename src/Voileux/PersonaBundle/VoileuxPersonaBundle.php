<?php

namespace Voileux\PersonaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Voileux\PersonaBundle\DependencyInjection\Security\Factory\PersonaFactory;

class VoileuxPersonaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new PersonaFactory());
    }
}
