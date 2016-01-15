<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use ASF\CoreBundle\ASFCoreBundle;

/**
 * Core Bundle tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFCoreBundleTest extends TestCase
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
	 */
	public function testBuild()
	{
		$bundle = new ASFCoreBundle();
		$bundle->build($this->container);
	}
}