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
 * Category controller
 *
 */
class CategoryController extends AbstractBackendController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Planet\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * Index action
	 *
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction() {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categories);
	}

	/**
	 * New action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 * @Flow\IgnoreValidation("$category")
	 */
	public function newAction(\TYPO3\Planet\Domain\Model\Category $category = NULL) {
		$this->view->assign('category', $category);
	}

	/**
	 * Create action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 */
	public function createAction(\TYPO3\Planet\Domain\Model\Category $category) {
		$this->categoryRepository->add($category);

		$this->addFlashMessage('Category created.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Edit action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 * @Flow\IgnoreValidation("$category")
	 */
	public function editAction(\TYPO3\Planet\Domain\Model\Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * Update action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 */
	public function updateAction(\TYPO3\Planet\Domain\Model\Category $category) {
		$this->categoryRepository->update($category);

		$this->addFlashMessage('Category updated.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

	/**
	 * Delete action
	 *
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 * @Flow\IgnoreValidation("$category")
	 */
	public function deleteAction(\TYPO3\Planet\Domain\Model\Category $category) {
		$this->categoryRepository->remove($category);

		$this->addFlashMessage('Category removed.', 'Success', \TYPO3\Flow\Error\Message::SEVERITY_OK);
		$this->redirect('index');
	}

}
?>