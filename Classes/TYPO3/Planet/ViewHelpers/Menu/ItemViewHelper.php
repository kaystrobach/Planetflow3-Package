<?php
namespace TYPO3\Planet\ViewHelpers\Menu;

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
 * Generate a menu item
 */
class ItemViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

	protected $tagName = 'a';

	/**
	 * Render a menu item (li) with correct icon color and active state.
	 *
	 * @param $controller
	 * @param null $action
	 * @param null $packageKey
	 * @param null $icon
	 * @param string $activeLevel
	 * @return string
	 * @throws \TYPO3\Flow\Mvc\Routing\Exception\MissingActionNameException
	 */
	public function render($controller, $action = NULL, $packageKey = NULL, $icon = NULL, $activeLevel = 'controller') {
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uri = $uriBuilder->reset()->uriFor($action, array(), $controller, $packageKey);

		$active = TRUE;
		if ($this->controllerContext->getRequest()->getControllerName() !== $controller) {
			$active = FALSE;
		}
		if ($activeLevel === 'action' && $this->controllerContext->getRequest()->getControllerActionName() !== $action) {
			$active = FALSE;
		}

		$prependLabelContent = '';
		if ($icon !== NULL) {
			$prependLabelContent = '<span class="' . $icon . '"></span> ';
		}

		$class = 'list-group-item';

		if ($active) {
			$class .= ' active';
		}
		$this->tag->addAttribute('class', $class);

		$this->tag->addAttribute('href', $uri);
		$this->tag->setContent($prependLabelContent . $this->renderChildren());
		return $this->tag->render();
	}

}
?>