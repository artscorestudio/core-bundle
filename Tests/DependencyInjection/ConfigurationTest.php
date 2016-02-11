<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Config\Definition\Processor;

/**
 * Bundle's Configuration Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ConfigurationTest extends TestCase
{
	/**
	 * Processes an array of configurations.
	 * 
	 * @param array $configs An array of configuration items to process
	 * 
	 * @return array The processed configuration
	 */
	public function process($configs)
	{
		$processor = new Processor();
		return $processor->processConfiguration(new Configuration(), $configs);
	}
}