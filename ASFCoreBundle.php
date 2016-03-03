<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass;

/**
 * Core Bundle
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFCoreBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ASFEntityManagerPass());
    }
}
