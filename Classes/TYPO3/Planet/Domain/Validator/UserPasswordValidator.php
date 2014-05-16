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
 * A validator for password on user creation / edit
 */
class UserPasswordValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @param \TYPO3\Planet\Domain\Dto\UserPassword $value
	 * @return void
	 */
	protected function isValid($value) {
		if (strlen($value->getPassword()) > 0 && strlen($value->getPassword()) < 8) {
			$this->result->forProperty('password')->addError(new \TYPO3\Flow\Validation\Error('Password must be at least 8 characters', 1332265186));
		}
		if ($value->getPassword() !== $value->getPasswordConfirmation()) {
			$this->result->forProperty('passwordConfirmation')->addError(new \TYPO3\Flow\Validation\Error('Password confirmation does not match', 1332264922));
		}
	}

}
?>