<?php


namespace Models;


class User
{
	/**
	 * @var int The ID of the user.
	 */
	private int $id;
	/**
	 * @var string The name of the user.
	 */
	private string $name;
	
	/**
	 * User constructor.
	 *
	 * @param int    $id   The ID of the user.
	 * @param string $name The name of the user.
	 */
	public function __construct(int $id, string $name)
	{
		$this->id = $id;
		$this->name = $name;
	}
	
	/**
	 * Gets the ID of the user.
	 *
	 * @return int The ID of the user.
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * Gets the name of the user.
	 *
	 * @return string The name of the user.
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * Sets the ID of the user.
	 *
	 * @param int $id The new ID of the user.
	 *
	 * @return void
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}
	
	/**
	 * Sets the name of the user.
	 *
	 * @param string $name The new name of the user.
	 *
	 * @return void
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}
}
