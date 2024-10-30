<?php

include('class.phpmailer.php');
class Email
{
	// notification to admin when new appointment arrived
	public function Notifyemail($hostname, $portno, $smtpemail, $email, $password, $subject_to_admin, $subject_to_admin)
	{
		global $wpdb;
		$Subject = $subject_to_admin;
		//$To = $admin_email;
		$Body = $body_for_admin;
		//$BlogName  = $BlogName ;
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = $hostname; 		// SMTP server
		$mail->SMTPDebug  = 1;		// enables SMTP debug information (for testing)// 1 = errors and messages , // 2 = messages only
		$mail->SMTPAuth   = true;           // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = $hostname;      // sets GMAIL as the SMTP server
		$mail->Port       = $portno;                   // set the SMTP port for the GMAIL server
		$mail->Username   = $smtpemail;  // GMAIL username
		$mail->Password   = $password;            // GMAIL password
		//$mail->SetFrom($admin_email, $BlogName);	//admin's mail
		//$mail->AddReplyTo($admin_email, $BlogName);	// admin's mail
		//print_r($email);
		//die;
		//foreach($email as $email){
			$mail->Subject    = $Subject;
			$mail->MsgHTML($Body);
			echo $email;
			$mail->AddAddress($email);	// sending email to
			echo $mail->Send();
			return true;
			//$wpdb->query("insert into `sendmail_lordlinus`(`id`,`email`,`subject`,`body`,`sent`) values('','$email','$subject_to_admin','$subject_to_admin','1')");
			
			}
	}
}


?>