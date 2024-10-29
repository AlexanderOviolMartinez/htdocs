<?php
namespace lib;

use \PDO;
use \PDOException;

class database 
{
    public function __construct()
    {
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8umb4';
        $dsn = 'mysql:host=$host;dbname=$db;charset=$charset';
        try {
        }
    }
}
