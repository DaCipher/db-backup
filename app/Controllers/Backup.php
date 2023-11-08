<?php

namespace App\Controllers;

use App\Controllers\Database\DatabaseController;
use App\Controllers\Email\EmailController;

class Backup
{


  protected object $config;

  public function __construct(Object $config)
  {
    $this->config = $config;

    $this->BackupDB();
  }

  public function BackupDB()
  {
    $db_dump = new DatabaseController([
      'host' => $this->config->db_host,
      'username' => $this->config->db_user,
      'password' => $this->config->db_password,
      'database' => $this->config->db_name,
      'filename' => $this->config->db_filename,
      'path' => $this->config->dump_path,
      'date' => $this->config->date
    ]);

    if ($db_dump->dumpDB()) {
      $this->SendDBFile();


      // Check if db dumb retention is enabled
      if (!$this->config->db_dump_retention) {

        // Delete all db dump files
        array_map('unlink', array_filter(glob($this->config->dump_path . "/*"), 'is_file'));
      }


      return;
    }
    die('Critcal Error: 500');
  }

  public function SendDBFile()
  {
    $mail = new EmailController($this->config);
    $db_dump_file = $this->config->dump_path . DIRECTORY_SEPARATOR . $this->config->date . "_" . $this->config->db_filename;
    $mail->sender([$this->config->mail_sender, $this->config->mail_sender_name])
      ->receiver([$this->config->mail_receiver, $this->config->mail_reciever_name])
      ->subject($this->config->mail_subject)
      ->attachment([$db_dump_file, $this->config->db_filename])
      ->body("Database backup for " . $this->config->date)
      ->send();
  }
}
