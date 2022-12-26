<?php

return (object) array(

  'date' => date('Y-m-d'),

  // DB Configuration
  'db_host' => 'localhost',
  'db_name' => 'test_db',
  'db_user' => 'test_db_user',
  'db_password' => 'test_db_password',
  'dump_path' => '/test_dump_path',
  'db_filename' => "test_db_filename.sql",

  //Mail Configuration
  'mail_host' => 'host.com',
  'mail_username' => 'test_email_user',
  'mail_password' => 'test_email_password',
  'mail_port' => 25,
  "mail_encryption" => "tls",
  "mail_debug" => 0,
  //   level 1 = client; will show you messages sent by the client

  // level 2  = client and server; will add server messages, it’s the recommended setting.

  // level 3 = client, server, and connection; will add information about the initial information, might be useful for discovering STARTTLS failures

  // level 4 = low-level information.

  // Use level 3 or level 4 if you are not able to
  "mail_sender" => "username@domain.com",
  "mail_sender_name" => "Sender Name",
  "mail_receiver" => "receiver@domain.com",
  "mail_receiver_name" => "Recipient Name",
  "mail_subject" => "Backup Email Subject",
  //Website Settings
  'site_name' => 'Site Name',

);
