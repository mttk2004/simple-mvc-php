<?php

namespace Core;


use Exception;


class ValidationException extends Exception
{
	public readonly array $errors;
	public readonly array $old;
	
	/**
	 * @throws ValidationException
	 */
	public static function throwError($errors, $old): void
	{
		$instance = new static;
		$instance->errors = $errors;
		$instance->old = $old;
		throw $instance;
	}
}
