<?php
/**
 * This file is part of Artscore Studio Framework
 *
 * (c) 2012-2013 Nicolas Claverie <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\CoreBundle\Tests\Form\Handler;

/**
 * Form Handler Model Test
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FormHandlerModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\Form\Handler\FormHandlerModel
     */
	public function testFormHandler()
	{
	    // Create a submitted and valided Form
	    $form = $this->getMock('Symfony\Component\Form\Form', array(), array(), '', false);
	    $form->expects($this->any())->method('handleRequest')->willReturn($form);
	    $form->method('getData')->willReturn(array());
	    $form->method('isSubmitted')->willReturn(true);
	    $form->method('isValid')->willReturn(true);
	    
	    // Create a Request
	    $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
	    
	    // Call to formHandler process when all is OK
	    $formHandler = $this->getMockForAbstractClass('ASF\CoreBundle\Form\Handler\FormHandlerModel', array($form, $request));
	    $formHandler->expects($this->any())->method('processForm')->willReturn(true);
	    
		$this->assertTrue($formHandler->process());
	}
}