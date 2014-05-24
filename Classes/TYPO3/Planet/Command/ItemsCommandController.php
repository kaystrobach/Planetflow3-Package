<?php
namespace TYPO3\Planet\Command;

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

use TYPO3\Planet\Domain\Model\Item as Item;

/**
 * Command controller to set up the TYPO3.Planet package
 *
 */
class ItemsCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\ChannelRepository
	 */
	protected $channelRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Service\ChannelService
	 */
	protected $channelService;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Log\FeedLoggerInterface
	 */
	public $feedLogger;

	/**
	 * Fetch new items from all channels
	 *
	 * This command should be run by a cronjob to do periodical
	 * updates to the channel feeds.
	 *
	 * @param boolean $verbose TRUE if log messages should be shown on the console
	 * @return void
	 */
	public function fetchCommand($verbose = FALSE) {
		if ($verbose) {
			echo 'Fetching feeds';
		}

		$command = $this;
		$channels = $this->channelRepository->findAll();
		foreach ($channels as $channel) {
			if ($verbose) {
				echo 'Fetching items for ' . $channel->getFeedUrl() . '...' . PHP_EOL;
			}
			$this->channelService->fetchItems($channel, function(Item $item, $message, $severity = LOG_INFO) use ($channel, $command, $verbose) {
				if ($verbose) {
					echo $message . PHP_EOL;
				}
				$command->feedLogger->log($channel->getName() . ': ' . $item->getLink() . ' - ' . $message, $severity);
			});
			if ($verbose) {
				echo "Done fetching items." . PHP_EOL;
			}
		}
	}

	/**
	 * Detect languages of items
	 *
	 * Should be used after an update of the language
	 * recognition files to re-classify items.
	 *
	 * @return void
	 */
	public function classifyLanguagesCommand() {
		$textcat = new \Chlu\Libtextcat\Textcat();
		$items = $this->itemRepository->findAll();
		foreach ($items as $item) {
			$language = $textcat->classify($item->getDescription() . ' ' . $item->getContent());
			if ($language !== FALSE) {
				echo "Detected language $language for " . $item->getUniversalIdentifier() . PHP_EOL;
				$item->setLanguage($language);
			}
		}
	}

	/**
	 * Apply filters
	 *
	 * Should be used after an update of the filter rules to re-apply filters
	 * to description and content of an item.
	 *
	 * @return void
	 */
	public function applyFiltersCommand() {
		$items = $this->itemRepository->findAll();
		foreach ($items as $item) {
			$item->setDescription($item->getDescription());
			$item->setContent($item->getContent());
			$this->itemRepository->update($item);
		}
	}

}
?>