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
 *
 */
class ControlGroupViewHelper extends \TYPO3\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'div';

	/**
	 * @return string
	 */
	public function render() {
		$cssClass = 'control-group';
		if ($this->hasArgument('class')) {
			$cssClass .= ' ' . $this->arguments['class'];
		}
		$mappingResultsForProperty = $this->getMappingResultsForProperty();
		if ($mappingResultsForProperty->hasErrors()) {
			if ($this->hasArgument('errorClass')) {
				$cssClass .= ' ' . $this->arguments['errorClass'];
			} else {
				$cssClass .= ' error';
			}
		}
		$this->tag->addAttribute('class', $cssClass);

		$this->tag->setContent($this->renderChildren());
		return $this->tag->render();
	}

	/**
	 * Get errors for the property and form name of this view helper
	 *
	 * @return array<\TYPO3\Flow\Error\Error> Array of errors
	 */
	protected function getMappingResultsForProperty() {
		$originalRequestMappingResults = $this->getRequest()->getInternalArgument('__submittedArgumentValidationResults');

		if (!$this->isObjectAccessorMode() && ($originalRequestMappingResults !== NULL)) {
			if (isset($this->arguments['name'])) {
				$formObjectName = $this->viewHelperVariableContainer->get('TYPO3\Fluid\ViewHelpers\FormViewHelper', 'formObjectName');
				$propertyPath = str_replace('[', '.', str_replace(']', '', $this->arguments['name']));
				return $originalRequestMappingResults->forProperty($formObjectName)->forProperty($propertyPath);
			} else {
				return new \TYPO3\Flow\Error\Result();
			}
		}
		return new \TYPO3\Flow\Error\Result();
	}

}
?>