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
  public string $dump_path;
  public string $backup_file;
  public object $DBConn;

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
    $this->dump_path = $db['path'];
    $this->backup_file = $this->dump_path . DIRECTORY_SEPARATOR . $db['filename'];
    $this->connectDB();
  }

  /**
   * Connect to Database Server.
   * @throws Exception if the database connection fails
   */

  public function connectDB()
  {

    try {
      new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
    } catch (\PDOException $e) {
      // For CLI App degugging
      echo "Database connection failed: " . $e->getMessage() . "\n";
      // For Error Logging.
      throw new  Exception("Database connection failed: {$e->getMessage()}" . "\n");
    }
  }
  /**
   * Dump Database backup file
   *
   * @return void
   */
  public function dumpDB()
  {

    // Check if backup folder exists
    if (!is_dir($this->dump_path)) {
      mkdir($this->dump_path);
      echo "Success: " . $this->dump_path . " directory created.\n";
    }

    $sql_dump = "mysqldump -h $this->host -u $this->username -p$this->password $this->db > $this->backup_file";

    /* // Uncomment if your DB user has empty password
    $sql_dump = "mysqldump -h $this->host -u $this->username $this->db > $this->backup_file";

    */

    try {
      system($sql_dump);
      echo "Database: $this->db has been dumped to $this->backup_file\n";
      return true;
    } catch (\PDOException $e) {
      echo "Database dump failed: " . $e->getMessage() . "\n";
      exit;
    }
  }
}
