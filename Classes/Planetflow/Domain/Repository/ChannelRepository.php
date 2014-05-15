<?php
namespace TYPO3\Planet\Domain\Repository;

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
 * A repository for Channels
 *
 * @Flow\Scope("singleton")
 */
class ChannelRepository extends \TYPO3\Flow\Persistence\Doctrine\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array('name' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING);

	/**
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findAll() {
		$query = $this->createQuery();
		return $query->execute();
	}

	/**
	 * Get a list of channels ordered by the count of associated items
	 *
	 * @param integer $limit
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findTopChannels($limit = 10) {
		$result = $this->entityManager
			->createQuery('SELECT c, SIZE(c.items) AS itemCount FROM \Planetflow3\Domain\Model\Channel c ORDER BY itemCount DESC')
			->setMaxResults($limit)
			->execute();
		$channels = array();
		foreach ($result as $entry) {
			$channels[] = $entry[0];
		}
		return $channels;
	}

}
?>