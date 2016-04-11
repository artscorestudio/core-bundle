<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass;
use \Mockery as m;

/**
 * Compiler Pass for Entity Managers tagged services
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass::process
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass::translateParameter
     */
    public function testProcessWithoutDefinedServices()
    {
    	$container = new ContainerBuilder();
    	
    	$compiler = new ASFEntityManagerPass();
    	$compiler->process($container);
    }
    
    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass
     */
    public function testProcessWithoutManagerClassAndWithFQCNEntity()
    {
    	$manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFEntityManager');
    	$container = new ContainerBuilder();
    	$container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASF\CoreBundle\Entity\MockUser'));
    	
    	$compiler = new ASFEntityManagerPass();
    	$compiler->process($container);
    	$this->assertTrue($container->hasDefinition('foo.manager'));
    }
    
    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass
     */
    public function testProcessWithoutManagerClassAndWithShortEntity()
    {
        $manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFEntityManager');
        $container = new ContainerBuilder();
        $container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASFCoreBundle:MockUser'));
    
        $compiler = new ASFEntityManagerPass();
        $compiler->process($container);
    
        $this->assertTrue($container->hasDefinition('foo.manager'));
    }
    
    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass
     */
    public function testProcessWithArgumentsInServiceDefinition()
    {
    	$manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFEntityManager');
    	$container = new ContainerBuilder();
    	$container->register('foo.manager', $manager)
    		->addTag('asf_core.manager', array('entity' => 'ASFCoreBundle:MockUser'))
    		->addArgument('test');
    	
    	$compiler = new ASFEntityManagerPass();
    	$compiler->process($container);
    
    	$args = $container->getDefinition('foo.manager')->getArguments();
    	
    	$this->assertCount(3, $args);
    }
}