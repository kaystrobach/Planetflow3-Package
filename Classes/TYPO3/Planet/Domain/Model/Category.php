<?php
namespace TYPO3\Planet\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Planet".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * A Category
 *
 * @Flow\Entity
 */
class Category {

	/**
	 * The name of this category
	 *
	 * @var string
	 * @Flow\Identity
	 * @ORM\Id
	 */
	protected $name;

	/**
	 * Items assigned to this category
	 * @var \Doctrine\Common\Collections\ArrayCollection<\TYPO3\Planet\Domain\Model\Item>
	 * @ORM\ManyToMany(mappedBy="categories", fetch="LAZY")
	 */
	protected $items;

	/**
	 * Constructor
	 *
	 * @param string $name
	 */
	public function __construct($name = '') {
		$this->name = $name;
	}

	/**
	 * Get the Category's name
	 *
	 * @return string The Category's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Category's name
	 *
	 * @param string $name The Category's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection<\TYPO3\Planet\Domain\Model\Item>
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection<\TYPO3\Planet\Domain\Model\Item> $items
	 */
	public function setItems($items) {
		$this->items = $items;
	}

}
?>