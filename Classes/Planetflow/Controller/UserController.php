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
 * User controller
 *
 */
class UserController extends AbstractBackendController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Index action
	 *
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction() {
		$users = $this->userRepository->findAll();
		$this->view->assign('users', $users);
	}

	/**
	 * New action
	 *
	 * @param \Planetflow\Domain\Model\User $user
	 * @Flow\IgnoreValidation("$user")
	 */
	public function newAction(\Planetflow\Domain\Model\User $user = NULL) {
		$this->view->assign('user', $user);
	}

	/**
	 * Create action
	 *
	 * @param \TYPO3\Planet\Domain\Model\User $user
	 * @param \TYPO3\Planet\Domain\Dto\UserPassword $userPassword
	 * @Flow\Validate("$userPassword", type="Planetflow3\Domain\Validator\CreateUserPasswordValidator")
	 */
	public function createAction(\TYPO3\Planet\Domain\Model\User $user, \TYPO3\Planet\Domain\Dto\UserPassword $userPassword) {
		$user->setPassword($userPassword->getPassword());
		$this->userRepository->add($user);

		$this->addFlashMessage('User created.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Edit action
	 *
	 * @param \TYPO3\Planet\Domain\Model\User $user
	 * @Flow\IgnoreValidation("$user")
	 */
	public function editAction(\TYPO3\Planet\Domain\Model\User $user) {
		$this->view->assign('user', $user);
	}

	/**
	 * Update action
	 *
	 * @param \TYPO3\Planet\Domain\Model\User $user
	 * @param \TYPO3\Planet\Domain\Dto\UserPassword $userPassword
	 * @Flow\Validate("$userPassword", type="Planetflow3\Domain\Validator\UserPasswordValidator")
	 */
	public function updateAction(\TYPO3\Planet\Domain\Model\User $user, \TYPO3\Planet\Domain\Dto\UserPassword $userPassword) {
		if ((string)$userPassword->getPassword() !== '') {
			$user->setPassword($userPassword->getPassword());
		}
		$this->userRepository->update($user);

		$this->addFlashMessage('User updated.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Delete action
	 *
	 * @param \TYPO3\Planet\Domain\Model\User $user
	 * @Flow\IgnoreValidation("$user")
	 */
	public function deleteAction(\TYPO3\Planet\Domain\Model\User $user) {
		$this->userRepository->remove($user);

		$this->addFlashMessage('User removed.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_NOTICE);
		$this->redirect('index');
	}

}
?>