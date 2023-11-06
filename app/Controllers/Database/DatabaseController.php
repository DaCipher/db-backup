<?php

namespace App\Controllers\Database;

use Exception;
use PDO;

class DatabaseController
{

  public string $host;
  public string $username;
  public string $password;
  public string $db;
  public string $backup_file;

  /**
   * Initializes the database controller using database configuration files.
   * @param Array $db ['host', 'username', 'password', 'database', 'backup_file']
   * @return null;
   */

  public function __construct($db)
  {
    $this->host = $db['host'];
    $this->username = $db['username'];
    $this->password = $db['password'];
    $this->db = $db['database'];
    $this->backup_file = $db['path'] . DIRECTORY_SEPARATOR . $db['date'] . "_" . $db['filename'];
    $this->connectDB();
  }

  /**
   * Connect to Database Server.
   * @return Object $conn Database connection object.
   */

  public function connectDB()
  {

    try {
      $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
      return $conn;
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function dumpDB()
  {
    $sql_dump = "mysqldump --host={$this->host} --user={$this->username} --password={$this->password} {$this->db} > $this->backup_file";

    try {
    exec($sql_dump);
      return true;
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }
}