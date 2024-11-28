<?php

namespace Core;

use Exception;

/**
 * Class ValidationException
 *
 * This class represents a validation exception that contains errors and old input data.
 */
class ValidationException extends Exception
{
	/**
	 * @var array $errors The array of validation errors.
	 */
	public readonly array $errors;
	
	/**
	 * @var array $old The array of old input data.
	 */
	public readonly array $old;
	
	/**
	 * Throws a ValidationException with the given errors and old input data.
	 *
	 * @param array $errors The validation errors.
	 * @param array $old    The old input data.
	 *
	 * @return void
	 *@throws ValidationException
	 */
	public static function throwError(array $errors, array $old): void
	{
		$instance = new static;
		$instance->errors = $errors;
		$instance->old = $old;
		throw $instance;
	}
}
