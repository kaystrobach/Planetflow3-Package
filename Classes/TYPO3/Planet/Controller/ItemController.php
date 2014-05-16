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
 * Item controller
 *
 */
class ItemController extends AbstractBackendController {

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
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * Index action
	 *
	 * @param \TYPO3\Planet\Domain\Dto\ItemFilter $filter
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction($filter = NULL) {
		if ($filter === NULL) {
			$filter = new \TYPO3\Planet\Domain\Dto\ItemFilter();
		}
		$items = $this->itemRepository->findByFilter($filter);
		$this->view->assign('items', $items);
		$this->view->assign('filter', $filter);

		$channels = $this->channelRepository->findAll();
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('channels', $channels->toArray());
		$this->view->assign('categories', $categories->toArray());
	}

	/**
	 * Edit action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Item $item
	 * @Flow\IgnoreValidation("$item")
	 */
	public function editAction(\TYPO3\Planet\Domain\Model\Item $item) {
		$categories = $this->categoryRepository->findAll();

		$this->view->assign('item', $item);
		$this->view->assign('categories', $categories);
	}

	/**
	 * Update action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Item $item
	 */
	public function updateAction(\TYPO3\Planet\Domain\Model\Item $item) {
		$this->itemRepository->update($item);

		$this->addFlashMessage('Item updated.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Enable action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Item $item
	 */
	public function enableAction(\TYPO3\Planet\Domain\Model\Item $item) {
		$item->setDisabled(FALSE);
		$this->itemRepository->update($item);

		$this->addFlashMessage('Item enabled.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Disable action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Item $item
	 */
	public function disableAction(\TYPO3\Planet\Domain\Model\Item $item) {
		$item->setDisabled(TRUE);
		$this->itemRepository->update($item);

		$this->addFlashMessage('Item disabled.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

}
?>