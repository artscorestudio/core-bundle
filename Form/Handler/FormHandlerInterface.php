<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;

/**
 * Form Handler Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface FormHandlerInterface
{
	/**
	 * @return \Symfony\Component\Form\FormInterface
	 */
	public function getForm();
	
	/**
	 * @param FormInterface $form
	 * @return \ASF\CoreBundle\Form\Handler\FormHandlerInterface
	 */
	public function setForm($form);
	
	/**
	 * Process Form
	 * 
	 * @return boolean
	 */
	public function process();
	
	/**
	 * This method must define the process logic for the entity (saving data process, etc.)
	 * 
	 * @param mixed $model 
	 * @return boolean
	 */
	public function processForm($model);
}