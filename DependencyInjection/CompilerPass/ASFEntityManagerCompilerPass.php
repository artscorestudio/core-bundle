<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Compiler Pass for Entity Managers tagged services
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface::process()
     */
    public function process(ContainerBuilder $container)
    {
        $tagged_services = $container->findTaggedServiceIds('asf_core.manager');

        foreach($tagged_services as $id => $tags) {
            foreach($tags as $attributes) {
                
                if ( !isset($attributes['entity']) ) {
                    throw new \LogicException(sprintf("Attribute entity missing for service tagged asf_core.manager for service id %s", $id));
                }
                
                $class = $this->translateParameter($container->getDefinition($id)->getClass());
                $entity = $this->translateParameter($attributes['entity']);
                
                if ( !class_exists($container->getParameter($class)) ) {
                    $container->getDefinition($id)->setClass('ASF\CoreBundle\Entity\Manager\ASFEntityManager');
                    $container->getDefinition($id)->addArgument(new Reference('doctrine.orm.entity_manager'));
                    $container->getDefinition($id)->addArgument($container->getParameter($entity));
                }
            }
        }
    }
    
    /**
     * Change parameter like %parameter_name% to parameter_name for get it with $container->getParamter('parameter_name')
     * 
     * @param strinng $parameter
     */
    protected function translateParameter($parameter)
    {
        return trim($parameter, '%');
    }
}