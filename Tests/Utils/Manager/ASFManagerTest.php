<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CoreBundle\Tests\Utils\Manager;

use ASF\CoreBundle\Utils\Manager\ASFManager;
use Doctrine\ORM\EntityRepository;

/**
 * Base class for Artscore Studio Framework Entity Managers.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class ASFManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager
     */
    public function testASFManager()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getFQCN
     */
    public function testASFManagerGetFQCNMethod()
    {
        $get_fqcn = self::getMethod('getFQCN');
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:Mock');

        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $get_fqcn->invokeArgs($em, array('ASFCoreBundle:Mock')));
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::isFQCNFormat
     */
    public function testASFManagerIsFQCNFormatMethod()
    {
        $is_fqcn = self::getMethod('isFQCNFormat');
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:Mock');

        $this->assertTrue($is_fqcn->invokeArgs($em, array('ASF\CoreBundle\Entity\Mock')));
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::createInstance
     */
    public function testASFManagerCreateInstanceMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, '\stdClass');
        $this->assertInstanceOf('\stdClass', $em->createInstance());
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getClassName
     */
    public function testASFManagerGetClassNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $em->getClassName());
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getEntityManager
     */
    public function testASFManagerGetEntityManagerMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $em->getEntityManager()->getRepository('ASF\CoreBundle\Entity\Mock')->getClassName());
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getClassName
     */
    public function testASFManagerGetRepositoryMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/EntityRepository/', get_class($em->getRepository()));
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getEntityName
     */
    public function testASFManagerGetEntityNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/Mock/', $em->getEntityName());
    }

    /**
     * @covers ASF\CoreBundle\Utils\Manager\ASFManager::getShortClassName
     */
    public function testASFManagerGetShortClassNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);

        $em = new ASFManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/ASFCoreBundle:Mock/', $em->getShortClassName());
    }

    /**
     * Access to protected methods.
     * 
     * @param string $name
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('ASF\CoreBundle\Utils\Manager\ASFManager');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
