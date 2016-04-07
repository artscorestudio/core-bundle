<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Tests\Entity\Manager;

use ASF\CoreBundle\Entity\Manager\ASFEntityManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Base class for Artscore Studio Framework Entity Managers
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager
     */
    public function testASFEntityManager()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getFQCN
     */
    public function testASFEntityManagerGetFQCNMethod()
    {
        $get_fqcn = self::getMethod('getFQCN');
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:Mock');
        
        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $get_fqcn->invokeArgs($em, array('ASFCoreBundle:Mock')));
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::isFQCNFormat
     */
    public function testASFEntityManagerIsFQCNFormatMethod()
    {
        $is_fqcn = self::getMethod('isFQCNFormat');
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:Mock');
    
        $this->assertTrue($is_fqcn->invokeArgs($em, array('ASF\CoreBundle\Entity\Mock')));
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::createInstance
     */
    public function testASFEntityManagerCreateInstanceMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
        
        $em = new ASFEntityManager($doctrine_em, '\stdClass');
        $this->assertInstanceOf('\stdClass', $em->createInstance());
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getClassName
     */
    public function testASFEntityManagerGetClassNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
        
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $em->getClassName());
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getEntityManager
     */
    public function testASFEntityManagerGetEntityManagerMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
    
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertEquals('ASF\CoreBundle\Entity\Mock', $em->getEntityManager()->getRepository('ASF\CoreBundle\Entity\Mock')->getClassName());
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getClassName
     */
    public function testASFEntityManagerGetRepositoryMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
    
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/EntityRepository/', get_class($em->getRepository()));
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getEntityName
     */
    public function testASFEntityManagerGetEntityNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
    
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/Mock/', $em->getEntityName());
    }
    
    /**
     * @covers ASF\CoreBundle\Entity\Manager\ASFEntityManager::getShortClassName
     */
    public function testASFEntityManagerGetShortClassNameMethod()
    {
        $doctrine_em = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->method('getClassName')->willReturn('ASF\CoreBundle\Entity\Mock');
        $doctrine_em->method('getRepository')->willReturn($repository);
    
        $em = new ASFEntityManager($doctrine_em, 'ASFCoreBundle:MockEntity');
        $this->assertRegExp('/ASFCoreBundle:Mock/', $em->getShortClassName());
    }
    
    /**
     * Access to protected methods
     * 
     * @param string $name
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('ASF\CoreBundle\Entity\Manager\ASFEntityManager');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}