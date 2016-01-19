<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFExtension extends Extension
{
	/**
	 * Maps parameters in container
	 * 
	 * @param ContainerBuilder $container
	 * @param string $rootNodeName
	 * @param array $config
	 */
	public function mapsParameters(ContainerBuilder $container, $rootNodeName, $config)
	{
		foreach($config as $name => $value) {
			if ( is_array($value) ) {
				$this->mapsParameters($container, $rootNodeName . '.' . $name, $value);
			} else {
				$container->setParameter($rootNodeName . '.' . $name, $value);
			}
		}
	}
}