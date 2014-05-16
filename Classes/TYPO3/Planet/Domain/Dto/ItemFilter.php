<?php
namespace TYPO3\Planet\Domain\Dto;

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
 * A item filter DTO
 */
class ItemFilter {

	/**
	 * @var \TYPO3\Planet\Domain\Model\Channel
	 */
	protected $channel;

	/**
	 * @var \TYPO3\Planet\Domain\Model\Category
	 */
	protected $category;

	/**
	 * @var string
	 */
	protected $language = NULL;

	/**
	 * @var string
	 */
	protected $disabled = NULL;

	/**
	 * @return \TYPO3\Planet\Domain\Model\Channel
	 */
	public function getChannel() {
		return $this->channel;
	}

	/**
	 * @param \TYPO3\Planet\Domain\Model\Channel $channel
	 */
	public function setChannel($channel) {
		$this->channel = $channel;
	}

	/**
	 * @return \TYPO3\Planet\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param \TYPO3\Planet\Domain\Model\Category $category
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param string $language
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * @return boolean
	 */
	public function getDisabled() {
		return $this->disabled;
	}

	/**
	 * @param boolean $disabled
	 */
	public function setDisabled($disabled) {
		$this->disabled = $disabled;
	}

}
?>