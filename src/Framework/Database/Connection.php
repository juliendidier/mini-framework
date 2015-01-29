<?php

namespace Framework\Database;

class Connection
{
    protected $dsn;
    protected $user;
    protected $password;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection()
    {
        return new \PDO(
            $this->dsn,
            $this->user,
            $this->password
        );
    }
}
