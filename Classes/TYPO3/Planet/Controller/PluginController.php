<?php
namespace TYPO3\Planet\Controller;

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
 * Plugin controller for the TYPO3.Planet Metablog plugin
 *
 */
class PluginController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\ChannelRepository
	 */
	protected $channelRepository;

	/**
	 * List recent items
	 *
	 * @param integer $itemsPerPage
	 * @return void
	 */
	public function itemsAction($itemsPerPage = 10) {
		$items = $this->itemRepository->findRecent(0, $itemsPerPage);
		$this->view->assign('items', $items);
	}

}
?>