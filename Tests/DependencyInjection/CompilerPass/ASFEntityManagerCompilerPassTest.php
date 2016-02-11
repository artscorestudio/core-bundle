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

use \Mockery as m;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Compiler Pass for Entity Managers tagged services
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerCompilerPassTest implements \PHPUnit_Framework_TestCase
{
	/**
	 * @var \Mockery\Mock|\Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected $container;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();
		$this->containert = $container;
	}
	
    /**
     * Test Compiler pass process method
     */
    public function testProcess()
    {
        
    }
    
    /**
     * Return a mock object of ContainerBuilder
     *
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected function getContainer($bundles = null, $extensions = null)
    {
    	$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
    
    	return $container;
    }
}