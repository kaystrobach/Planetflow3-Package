<?php
namespace TYPO3\Planet\Domain\Validator;

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
 * A validator for password on user creation
 */
class CreateUserPasswordValidator extends UserPasswordValidator {

	/**
	 * @param \TYPO3\Planet\Domain\Dto\UserPassword $value
	 * @return void
	 */
	protected function isValid($value) {
		parent::isValid($value);
		if ((string)$value->getPassword() === '') {
			$this->result->forProperty('password')->addError(new \TYPO3\Flow\Validation\Error('This property is required', 1332264528));
		}
	}

}
?>