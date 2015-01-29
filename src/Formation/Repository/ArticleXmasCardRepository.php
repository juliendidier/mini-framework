<?php

namespace Formation\Repository;

use Framework\Database\Connection;

class ArticleXmasCardRepository
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM article_xmascard';
        $stmt = $this->connection->getConnection()->query($query);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'Formation\Model\XmasCard');
    }

    public function find($name)
    {
        $query = 'SELECT * FROM article_xmascard WHERE name = :name';

        $stmt = $this->connection->getConnection()->prepare($query);
        $stmt->execute(array(
            'name' => $name,
        ));

        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Formation\Model\XmasCard'); 

        return $stmt->fetch();
    }
} 


