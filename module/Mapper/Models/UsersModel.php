<?php

namespace Mapper;

class UsersModel
{
    private $id = 'id';
    private $username = 'username';
    private $password = 'password';
    private $created_at = 'created_at';

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return UsersModel
     */
    public function setId(string $id): UsersModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UsersModel
     */
    public function setUsername(string $username): UsersModel
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UsersModel
     */
    public function setPassword(string $password): UsersModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return UsersModel
     */
    public function setCreatedAt(string $created_at): UsersModel
    {
        $this->created_at = $created_at;
        return $this;
    }



}