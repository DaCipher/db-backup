<?php

namespace App\Controllers\Email;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Controllers\BaseController;

class EmailController
{

  public String $sender;

  public String $receiver;

  public Object $mail;





  public function __construct($config)

  {

    //Create an instance; passing true` enables exceptions`

    $this->mail = new PHPMailer(true);

    //Server settings

    $this->mail->SMTPDebug = $config->mail_debug;                      //Enable verbose debug output

    $this->mail->isSMTP();                                            //Send using SMTP

    $this->mail->Host = $config->mail_host; //'smtp.example.com';                     //Set the SMTP server to send through

    $this->mail->SMTPAuth = true;                                   //Enable SMTP authentication

    $this->mail->Username = $config->mail_username;                     //SMTP username

    $this->mail->Password = $config->mail_password;                               //SMTP password

    $this->mail->SMTPSecure =  $config->mail_encryption; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

    $this->mail->Port = $config->mail_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $this->mail->isHTML(true); //Set email format to HTML

  }

  public function sender($sender = ["email", "name"])

  {
    $this->mail->setFrom($sender[0], $sender[1]);
    return $this;
  }



  public function receiver(array $receiver = ["receiver", "name"])

  {
    $this->mail->addAddress($receiver[0], $receiver[1]);     //Add a recipient
    return $this;
  }



  public function replyTo(array $replyTo = ["email", "name"])

  {

    $this->mail->addReplyTo($replyTo[0], $replyTo[1]);

    return $this;
  }





  public function cc($cc = ["email", "name"])

  {

    $this->mail->addCC($cc[0], $cc[1]);

    return $this;
  }



  public function bcc($bcc = ["email", "name"])

  {

    $this->mail->addBCC($bcc[0], $bcc[1]);
    return $this;
  }



  public function attachment($attachment = ["path", "name"])

  {

    $this->mail->addAttachment($attachment[0], $attachment[1]);    //Optional name

    return $this;
  }



  public function subject(String $subject)

  {
    $this->mail->Subject = $subject;
    return $this;
  }



  public function body(String $body)

  {
    $this->mail->Body    = $body;
    $this->mail->AltBody = $body;
    return $this;
  }



  /**
   * Send Email Message
   *
   * @return
   */
  public function send()

  {

    try {

      $this->mail->send();
      echo "Email sent successfully\n";
      return true;
    } catch (Exception $e) {
      // For CLI App debugging
      echo $this->mail->ErrorInfo . "\n";

      // For error logging
      throw new Exception("Unable to send mail: " . $this->mail->ErrorInfo . "\n");
    }
  }
}
