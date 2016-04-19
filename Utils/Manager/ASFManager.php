<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Utils\Manager;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Base class for Artscore Studio Framework Entity Managers
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFManager implements ASFManagerInterface
{
	/**
	 * @var \Doctrine\ORM\EntityManagerInterface
	 */
	protected $entityManager;
	
	/**
	 * @var string
	 */
	protected $entityName;
	
	/**
	 * @param EntityManager $entity_manager
	 */
	public function __construct(EntityManagerInterface $entity_manager, $entity_name)
	{
		$this->entityManager = $entity_manager;
		if ( $this->isFQCNFormat($entity_name) ) {
			$this->entityName = $entity_name;
		} else {
			$this->entityName = $this->getFQCN($entity_name);
		}
	}
	
	/**
	 * Check if the given entity class name is in format AcmeDemoBundle:EntityName
	 *
	 * @param string $entity_name
	 * @return boolean
	 */
	protected function isFQCNFormat($entity_name)
	{
		return 1 === preg_match('/^([A-Z][a-zA-Z0-9]+[\\\\]{1})([A-Z][a-zA-Z0-9]+[\\\\]{1})+([A-Z][a-zA-Z0-9]+)$/', $entity_name);
	}
	
	/**
	 * Return FQCN entity name
	 *
	 * @param string $entity_name
	 * @return string
	 */
	protected function getFQCN($entity_name)
	{
		$parts = explode(':', $entity_name);
		$entity = end($parts);
	
		if ( 1 === preg_match('/^([A-Z][a-zA-Z]+)([A-Z][a-zA-Z]+)(Bundle)$/', $parts[0], $matches) ) {
			return $matches[1].'\\'.$matches[2].$matches[3].'\\Entity\\'.$entity;
		}
	
		return $entity_name;
	}
	
	/**
	 * Create new instance of the entity
	 *
	 * @return object
	 */
	public function createInstance()
	{
		if ( is_null($this->entityName) ) {
			$class = new \ReflectionClass($this->originalEntityName);
		} else {
			$class = new \ReflectionClass($this->entityName);
		}
		return $class->newInstanceArgs();
	}
	
	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager()
	{
		return $this->entityManager;
	}
	
	/**
	 * Return the repository for the entity managed by the Entity Manager
	 *
	 * @return \Doctrine\ORM\EntityRepository
	 */
	public function getRepository()
	{
		return $this->entityManager->getRepository($this->entityName);
	}
	
	/**
	 * Get the entity class name
	 *
	 * @return string
	 */
	public function getClassName()
	{
		return $this->getRepository()->getClassName();
	}
	
	/**
	 * Return the name of the entity
	 *
	 * @return string
	 */
	public function getEntityName()
	{
		$fullname = explode('\\', $this->getClassName());
		return end($fullname);
	}
	
	/**
	 * Return the entity name like AcmoeDemoBundle:Entity
	 * @return string
	 */
	public function getShortClassName()
	{
		$fullname = explode('\\', $this->getClassName());
		return $fullname[0].$fullname[1].':'.end($fullname);
	}
}