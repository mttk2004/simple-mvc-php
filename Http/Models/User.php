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
     * @var string The email of the user.
     */
    private string $email;
    /**
     * @var string The password of the user.
     */
    private string $password;

    /**
     * User constructor.
     *
     * @param int    $id   The ID of the user.
     * @param string $name The name of the user.
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
     * Gets the email of the user.
     *
     * @return string The email of the user.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets the password of the user.
     *
     * @return string The password of the user.
     */
    public function getPassword(): string
    {
        return $this->password;
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

    /**
     * Sets the email of the user.
     *
     * @param string $email The new email of the user.
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Sets the password of the user.
     *
     * @param string $password The new password of the user.
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
