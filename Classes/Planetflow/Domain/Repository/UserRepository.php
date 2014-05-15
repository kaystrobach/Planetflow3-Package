<?php
namespace Planetflow3\Domain\Repository;

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
 * A repository for Users
 *
 * @Flow\Scope("singleton")
 */
class UserRepository extends \TYPO3\Flow\Persistence\Doctrine\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array('emailAddress' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING);

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @param \Planetflow3\Domain\Model\User $object
	 */
	public function add($object) {
		$this->accountRepository->add($object->getPrimaryAccount());
		parent::add($object);
	}

	/**
	 *
	 * @param \Planetflow3\Domain\Model\User $object
	 */
	public function update($object) {
		$this->accountRepository->update($object->getPrimaryAccount());
		parent::update($object);
	}

	/**
	 * @param \Planetflow3\Domain\Model\User $object
	 */
	public function remove($object) {
		$this->accountRepository->remove($object->getPrimaryAccount());
		parent::remove($object);
	}

}
?>