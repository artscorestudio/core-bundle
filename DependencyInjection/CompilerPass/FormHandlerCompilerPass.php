<?php
/**
 * This file is part of Artscore Studio Framework
 *
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\CoreBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Form Handler Compiler Pass
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FormHandlerCompilerPass implements CompilerPassInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface::process()
	 */
	public function process(ContainerBuilder $container)
	{
		$taggedServices = $container->findTaggedServiceIds('form_handler.factory');

		foreach ($taggedServices as $id => $attributes) {
			$definition = $container->getDefinition($id);
			$definition
				->addMethodCall('setRequest', array(new Reference('request_stack')))
				->addMethodCall('setTranslator', array(new Reference('translator')))
				->addMethodCall('setAuthorizationChecker', array(new Reference('security.authorization_checker')))
				->addMethodCall('setTokenStorage', array(new Reference('security.token_storage')));
		}
	}
}
