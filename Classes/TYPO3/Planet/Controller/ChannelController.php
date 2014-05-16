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
 * Channel controller
 *
 */
class ChannelController extends AbstractBackendController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\ChannelRepository
	 */
	protected $channelRepository;

	/**
	 * Index action
	 *
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction() {
		$channels = $this->channelRepository->findAll();
		$this->view->assign('channels', $channels);
	}

	/**
	 * New action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 * @Flow\IgnoreValidation("$channel")
	 */
	public function newAction(\TYPO3\Planet\Domain\Model\Channel $channel = NULL) {
		$this->view->assign('channel', $channel);
	}

	/**
	 * Create action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 */
	public function createAction(\TYPO3\Planet\Domain\Model\Channel $channel) {
		$this->channelRepository->add($channel);

		$this->addFlashMessage('Channel created.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Edit action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 * @Flow\IgnoreValidation("$channel")
	 */
	public function editAction(\TYPO3\Planet\Domain\Model\Channel $channel) {
		$this->view->assign('channel', $channel);
	}

	/**
	 * Update action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 */
	public function updateAction(\TYPO3\Planet\Domain\Model\Channel $channel) {
		$this->channelRepository->update($channel);

		$this->addFlashMessage('Channel updated.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Delete action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 * @Flow\IgnoreValidation("$channel")
	 */
	public function deleteAction(\TYPO3\Planet\Domain\Model\Channel $channel) {
		$this->channelRepository->remove($channel);

		$this->addFlashMessage('Channel removed.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_NOTICE);
		$this->redirect('index');
	}

}
?>