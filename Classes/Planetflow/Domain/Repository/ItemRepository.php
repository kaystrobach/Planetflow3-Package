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
 * A repository for Items
 *
 * @Flow\Scope("singleton")
 */
class ItemRepository extends \TYPO3\Flow\Persistence\Doctrine\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array('publicationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING);

	/**
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findAll() {
		$query = $this->createQuery();
		return $query->execute();
	}

	/**
	 * Find items by filter for management
	 *
	 * @param \TYPO3\Planet\Domain\Dto\ItemFilter $filter
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findByFilter(\TYPO3\Planet\Domain\Dto\ItemFilter $filter = NULL) {
		$query = $this->createQuery();
		$constraints = array();
		if ($filter === NULL) {
			$filter = new \TYPO3\Planet\Domain\Dto\ItemFilter();
		}
		if ((string)$filter->getLanguage() !== '') {
			$constraints[] = $query->equals('language', $filter->getLanguage());
		}
		if ($filter->getDisabled() !== NULL) {
			$constraints[] = $query->equals('disabled', $filter->getDisabled());
		}
		if ($filter->getChannel() !== NULL) {
			$constraints[] = $query->equals('channel', $filter->getChannel());
		}
		if ($filter->getCategory() !== NULL) {
			$constraints[] = $query->contains('categories', $filter->getCategory());
		}
		if (count($constraints) > 0) {
			$query->matching($query->logicalAnd($constraints));
		}
		return $query->execute();
	}

	/**
	 * Get a grouped list of years with months and counts of all items
	 *
	 * @return array
	 */
	public function getGroupedYearsAndMonthsWithCount() {

	}

}
?>