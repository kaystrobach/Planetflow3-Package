<?php
namespace TYPO3\Planet\Tests\Functional\Controller;

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
 * Functional tests for the StandardController
 */
class StandardControllerTest extends \TYPO3\Flow\Tests\FunctionalTestCase {

	/**
	 * @var boolean
	 */
	static protected $testablePersistenceEnabled = TRUE;

	/**
	 * @var \TYPO3\Planet\Domain\Repository\ChannelRepository
	 */
	protected $channelRepository;

	/**
	 * @var \TYPO3\Planet\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * Set up dependencies
	 */
	public function setUp() {
		parent::setUp();
		$this->channelRepository = $this->objectManager->get('TYPO3\Planet\Domain\Repository\ChannelRepository');
		$this->itemRepository = $this->objectManager->get('TYPO3\Planet\Domain\Repository\ItemRepository');

		$this->persistenceManager = $this->objectManager->get('TYPO3\Flow\Persistence\PersistenceManagerInterface');
	}

	/**
	 * @test
	 */
	public function indexActionWithoutParametersRendersRecentItems() {
		$this->createTestData();

		$this->persistenceManager->persistAll();
		$this->persistenceManager->clearState();

		$result = $this->sendWebRequest('Standard', 'TYPO3.Planet', 'index');

		// TODO Test actual output contains item
	}

	/**
	 * @test
	 */
	public function feedActionWithoutParametersRendersFeed() {
		$this->createTestData();

		$this->persistenceManager->persistAll();
		$this->persistenceManager->clearState();

		$result = $this->sendWebRequest('Standard', 'TYPO3.Planet', 'feed');
		// TODO Test actual output contains item
	}

	/**
	 * Create some test data
	 *
	 * @return void
	 */
	protected function createTestData() {
		$channel = new \TYPO3\Planet\Domain\Model\Channel();
		$channel->setName('Test channel');
		$channel->setUrl('http://www.example.com');
		$channel->setFeedUrl('http://www.example.com/rss.xml');

		$this->channelRepository->add($channel);

		$item = new \TYPO3\Planet\Domain\Model\Item();
		$item->setChannel($channel);
		$item->setAuthor('Test author');
		// $item->setCategories(array('FLOW3'));
		$item->setTitle('A test post');
		$item->setContent('My random content');
		$item->setDescription('Some description');
		$item->setLanguage('en');
		$item->setLink('http://www.example.com/posts/2');
		$item->setPublicationDate(new \DateTime('2011-10-09 08:07:06'));
		$item->setUniversalIdentifier('http://www.example.com/posts/2');

		$this->itemRepository->add($item);
	}
}
?>