<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Entity\Manager;

/**
 * Artscore Studio Framework Entity Manager Interface 
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ASFEntityManagerInterface
{
    /**
     * Create new instance of the entity
     *
     * @return object
     */
    public function createInstance();
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager();
    
    /**
     * Return the repository for the entity managed by the Entity Manager
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository();
    
    /**
     * Get the entity class name
     *
     * @return string
     */
    public function getClassName();
}