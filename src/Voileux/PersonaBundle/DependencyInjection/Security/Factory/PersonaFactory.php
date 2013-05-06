<?php
/**
 * PersonaFactory.php
 *
 * Created By: jonathan
 * Date: 5/6/13
 * Time: 10:24 PM
 */

namespace Voileux\PersonaBundle\DependencyInjection\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;

class PersonaFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.persona.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('voileux.persona.authentication.provider'))
            ->replaceArgument(0, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.persona.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('voileux.persona.authentication.listener'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }
//
//    public function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
//    {
//        $authProviderId = 'persona.auth.'.$id;
//
//        $definition = $container
//            ->setDefinition($authProviderId, new DefinitionDecorator('voileux.persona.authentication.provider'))
//            ->replaceArgument(0, $id);
//
//        return $authProviderId;
//    }
//
//    public function getListenerId()
//    {
//        return 'voileux.persona.authentication.listener';
//    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'persona';
    }

    public function addConfiguration(NodeDefinition $node)
    {
    }
}
