<?php
namespace Planetflow3\Domain\Dto;

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
 * A item filter DTO
 */
class ItemFilter {

	/**
	 * @var \Planetflow3\Domain\Model\Channel
	 */
	protected $channel;

	/**
	 * @var \Planetflow3\Domain\Model\Category
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
	 * @return \Planetflow3\Domain\Model\Channel
	 */
	public function getChannel() {
		return $this->channel;
	}

	/**
	 * @param \Planetflow3\Domain\Model\Channel $channel
	 */
	public function setChannel($channel) {
		$this->channel = $channel;
	}

	/**
	 * @return \Planetflow3\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param \Planetflow3\Domain\Model\Category $category
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