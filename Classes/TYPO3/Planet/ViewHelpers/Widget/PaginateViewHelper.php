<?php
namespace TYPO3\Planet\ViewHelpers\Widget;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Planet".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Custom paginate widget
 */
class PaginateViewHelper extends \TYPO3\Fluid\ViewHelpers\Widget\PaginateViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\ViewHelpers\Widget\Controller\PaginateController
	 */
	protected $controller;

}
?>