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
use Mockery as m;

/**
 * Compiler Pass for Entity Managers tagged services.
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class ASFManagerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFManagerPass::process
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFManagerPass::translateParameter
     */
    public function testProcessWithoutDefinedServices()
    {
        $container = new ContainerBuilder();

        $compiler = new ASFManagerPass();
        $compiler->process($container);
    }

    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFManagerPass
     */
    public function testProcessWithoutManagerClassAndWithFQCNEntity()
    {
        $manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFManager');
        $container = new ContainerBuilder();
        $container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASF\CoreBundle\Entity\MockUser'));

        $compiler = new ASFManagerPass();
        $compiler->process($container);
        $this->assertTrue($container->hasDefinition('foo.manager'));
    }

    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFManagerPass
     */
    public function testProcessWithoutManagerClassAndWithShortEntity()
    {
        $manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFManager');
        $container = new ContainerBuilder();
        $container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASFCoreBundle:MockUser'));

        $compiler = new ASFManagerPass();
        $compiler->process($container);

        $this->assertTrue($container->hasDefinition('foo.manager'));
    }

    /**
     * @covers ASF\CoreBundle\DependencyInjection\Compiler\ASFManagerPass
     */
    public function testProcessWithArgumentsInServiceDefinition()
    {
        $manager = m::mock('ASF\CoreBundle\Utils\Manager\ASFManager');
        $container = new ContainerBuilder();
        $container->register('foo.manager', $manager)
            ->addTag('asf_core.manager', array('entity' => 'ASFCoreBundle:MockUser'))
            ->addArgument('test');

        $compiler = new ASFManagerPass();
        $compiler->process($container);

        $args = $container->getDefinition('foo.manager')->getArguments();

        $this->assertCount(3, $args);
    }
}
