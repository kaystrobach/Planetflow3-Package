<?php
namespace TYPO3\Planet\ViewHelpers;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Planet".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * A view helper to manipulate options
 *
 */
class OptionsViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 *
	 * @param array $options
	 * @param string $prependBlank If set a blank option will be prepended with this label
	 * @return string
	 */
	public function render($options = NULL, $prependBlank = NULL) {
		if ($options === NULL) {
			$options = $this->renderChildren();
		}
		$options = (array)$options;

		if ($prependBlank !== NULL) {
			$options = array_reverse($options, TRUE);
			$options[''] = $prependBlank;
			$options = array_reverse($options, TRUE);
		}

		return $options;
	}

}
?>