<?php
namespace TYPO3\Planet\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Planetflow3".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Overview controller
 */
class OverviewController extends AbstractBackendController {

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
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction() {
		$items = $this->itemRepository->findByFilter(NULL);
		$recentItems = $items->getQuery()->setLimit(5)->execute();

		$this->view->assign('itemCount', $this->itemRepository->countAll());
		$this->view->assign('recentItems', $recentItems);
		$this->view->assign('channelCount', $this->channelRepository->countAll());
		$this->view->assign('topChannels', $this->channelRepository->findTopChannels());
	}

}
?>