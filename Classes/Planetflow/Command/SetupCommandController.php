<?php
namespace Planetflow3\Command;

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
 * Command controller to set up the Planetflow3 package
 *
 */
class SetupCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \Planetflow3\Domain\Repository\ChannelRepository
	 */
	protected $channelRepository;

	/**
	 * @Flow\Inject
	 * @var \Planetflow3\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @Flow\Inject
	 * @var \Planetflow3\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @Flow\Inject
	 * @var \Planetflow3\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Create sample data
	 *
	 * @return void
	 */
	public function sampleDataCommand() {
		$this->itemRepository->removeAll();
		$this->channelRepository->removeAll();
		$this->categoryRepository->removeAll();

		$flow3Category = new \Planetflow3\Domain\Model\Category('FLOW3');
		$this->categoryRepository->add($flow3Category);
		$phpCategory = new \Planetflow3\Domain\Model\Category('PHP');
		$this->categoryRepository->add($phpCategory);
		$phoenixCategory = new \Planetflow3\Domain\Model\Category('Phoenix');
		$this->categoryRepository->add($phoenixCategory);

		$channels = array();

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('news.typo3.org: FLOW3');
		$channel->setUrl('http://news.typo3.org/news/teams/flow3/');
		$channel->setFeedUrl('http://news.typo3.org/news/teams/flow3/rss.xml');
		$channel->setDefaultCategory($flow3Category);
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('Karsten Dambekalns - Code & Content');
		$channel->setUrl('http://blog.k-fish.de');
		$channel->setFeedUrl('http://blog.k-fish.de/feeds/posts/default');
		$channel->setFetchedCategories(array('PHP', 'FLOW3'));
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('networkteam Blog - FLOW3');
		$channel->setUrl('http://www.networkteam.com/blog.html');
		$channel->setFeedUrl('http://www.networkteam.com/rss.xml');
		$channel->setFilter('FLOW3');
		$channel->setDefaultCategory($flow3Category);
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('Robert Lemke - Fluent Code Artisan');
		$channel->setUrl('http://robertlemke.de/blog/');
		$channel->setFeedUrl('http://robertlemke.de/blog/feeds/posts.rss.xml');
		$channel->setFilter('FLOW3,PHP');
		$channel->setDefaultCategory($flow3Category);
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('t3blog.de');
		$channel->setUrl('http://t3blog.de');
		$channel->setFeedUrl('http://t3blog.de/feed/');
		$channel->setFilter('FLOW3');
		$channel->setDefaultCategory($flow3Category);
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$channel = new \Planetflow3\Domain\Model\Channel();
		$channel->setName('layh.com');
		$channel->setUrl('http://www.layh.com');
		$channel->setFeedUrl('http://www.layh.com/wordpress/feed/');
		$channel->setFetchedCategories(array('FLOW3'));
		$this->channelRepository->add($channel);
		$channels[] = $channel;

		$this->outputLine('Created default categories and channels');
	}

	/**
	 * Create a user for administration
	 *
	 * The user will get the SystemAdministrator role to manage all data and users.
	 *
	 * @param string $emailAddress E-mail address (account identifier) of the new user
	 * @return void
	 */
	public function createUserCommand($emailAddress) {
		$uuid = \TYPO3\Flow\Utility\Algorithms::generateUUID();
		$password = substr($uuid, 0, 10);
		$user = new \Planetflow3\Domain\Model\User();
		$user->setEmailAddress($emailAddress);
		$user->setPassword($password);
		$user->setRole('SystemAdministrator');

		$this->userRepository->add($user);

		echo "Password: $password" . PHP_EOL;
	}

}
?>