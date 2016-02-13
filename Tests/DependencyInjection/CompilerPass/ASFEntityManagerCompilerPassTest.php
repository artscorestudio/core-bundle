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
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Compiler Pass for Entity Managers tagged services
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerCompilerPassTest extends \PHPUnit_Framework_TestCase
{
	/**
     * @var m\Mock|\Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;
    
    /**
     * @var m\Mock|\Symfony\Component\HttpKernel\KernelInterface
     */
    private $kernel;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $this->container->shouldReceive('register');
        $this->container->shouldReceive('hasDefinition');
        $this->container->shouldReceive('getDefinition');
        $this->container->shouldReceive('setDefinitions');
        $this->container->shouldReceive('findTaggedServiceIds');
        
        $this->kernel = m::mock('Symfony\Component\HttpKernel\KernelInterface');
        $this->kernel->shouldReceive('getName')->andReturn('app');
        $this->kernel->shouldReceive('getEnvironment')->andReturn('prod');
        $this->kernel->shouldReceive('isDebug')->andReturn(false);
        $this->kernel->shouldReceive('getContainer')->andReturn($this->container);
        $this->kernel->shouldReceive('getBundles');
    }
    
    /**
     * Test compiler pass without any services are defined as entity manager
     */
    public function testProcess()
    {
    	$manager = m::mock('ASF\CoreBundle\Entity\Manager\ASFEntityManager');
    	$container = new ContainerBuilder();
    	$container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASF\CoreBundle\Tests\Fixtures\Manager\MockUser'));
    	
    	$compiler = new ASFEntityManagerCompilerPass();
    	$compiler->process($container);
    	
    	$this->assertTrue($container->hasDefinition('foo.manager'));
    }
}