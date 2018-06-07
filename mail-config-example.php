<?php

require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

class SendMail
{
	protected $smtphost;
	protected $username;
	protected $password;
	
	public function __construct()
	{
		# code...
		$this->smtphost = "localhost";
		$this->username = "myemail@mydomain.com";
		$this->password = "password";
	}


	public function send($from, $to, $subject, $body){

		// configure 
		$text = $body; // text version of email.
		$html = $body; // html version can be modify

		// configure header
		$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);

		//do not ever try to call these lines in reverse order
		$body = $mime->get();
		$headers = $mime->headers($headers);


		$smtp = Mail::factory('smtp', [
			'host' => $this->smtphost, 
			'auth' => true,
			'username' => $this->username,
			'password' => $this->password
		]);

		$mail = $smtp->send($to, $headers, $body);

		if(PEAR::isError($mail)) {
			echo "Error sending mail<br /> ".$mail->getMessage();
		}else {
			echo "Message successfully sent!");
		    // header("Location: http://www.example.com/");
		}
	}
}

