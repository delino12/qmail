# How to use
	Require the class each time you want to send mail


# To send a mail
	initialize the send mail class
	Example:
	- $send_mail = new SendMail(); 
    - $sent = $send_mail->send($from, $to, $subject, $body);