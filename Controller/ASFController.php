<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Artscore Controller for personnalize controllers commons methods if necessary
 *
 * @author Artscore Studio (info@artscore-studio.fr)
 *
 */
class ASFController extends Controller
{
	/**
	 * @return \Symfony\Component\Translation\Translator
	 */
	public function getTranslator()
	{
		return $this->get('translator');
	}
}