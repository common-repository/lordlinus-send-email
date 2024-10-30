<?php
/* 	Plugin Name: Lordlinus send email
	Plugin Uri: http://businessadwings.com
	Description: This plugin allows you to send email to your contacts, here you will be able to import your gmail contact and send wishes mail or reminder mails to them
	Version: 1.1
	Author: lordlinus
	Author URI: http://businessadwings.com/contact-us
	Licence: GPVl
*/
?>
<?php
register_activation_hook( __FILE__, 'InstallScriptlordsend' );
function InstallScriptlordsend()
{
	include('install-script1.php');
}


function sendmailusingwordpressgmail()
{
	echo "<link rel='stylesheet' type='text/css' href='".plugins_url('/bootstrap-assets/css/bootstrap.css', __FILE__)."' />";
	wp_enqueue_script(array('jquery', 'editor', 'thickbox', 'media-upload'));
	add_menu_page( 'Send Mail', 'Send Mail', 'administrator','send-mail' ,'send_mail',plugins_url('/gmail.jpg',__FILE__));
	add_submenu_page('send-mail', 'Send Mail','Setting','administrator','setting-mail','setting_mail');
}
add_action( 'admin_menu','sendmailusingwordpressgmail' );
add_action("admin_head","myplugin_load_tiny_mce");

function setting_mail()
{
	include_once("setting_page.php");
}

function myplugin_load_tiny_mce() {

wp_tiny_mce( false ); // true gives you a stripped down version of the editor

}
?>
<script>
function check_values()
{
	var emails = jQuery("#emailid").val();
	if(emails == '')
	{
		alert("Please Enter email ids");
		return false;
	}
}
</script>
<?php
function send_mail()
{
	
	?>
	<div class="span12" style="margin-top:25px;">

	<div class="span12" >
	<div class="alert alert-info">Now Send Emails to your customers for free with us </div>
		<?php
		global $wpdb;
	if(isset($_POST['sendmail']))
	{
		if(get_option('smtphostlord')=='')
		{
			echo "<div class='alert alert-danger'>Your mail would not be sent untill you set your setting by <a href='?page=setting-mail'> setting menu</a></div>";
		}
		else
		{
			$email_list = $_POST['emailid'];
			$email_array = explode(',',$email_list);
				
			$subject = $_POST['subject'];
			$body = $_POST['content'];
			
				include('notification/class.phpmailer.php');
			
			
			$smtphost = get_option('smtphostlord');
			$smtpportlord = get_option('smtpportlord');
			$smtpemailord = get_option('smtpemailord');
			$smtppasslord = get_option('smtppasslord');
			
			
			
			foreach($email_array as $email )
			{
			//	$email = $email_array;
				//die;
			
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = $smtphost; 		// SMTP server
			$mail->SMTPDebug  = 1;		// enables SMTP debug information (for testing)// 1 = errors and messages , // 2 = messages only
			$mail->SMTPAuth   = true;           // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = $smtphost;      // sets GMAIL as the SMTP server
			$mail->Port       = $smtpportlord;                   // set the SMTP port for the GMAIL server
			$mail->Username   = $smtpemailord;  // GMAIL username
			$mail->Password   = $smtppasslord;            // GMAIL password
			$mail->Subject    = $subject;
			$mail->MsgHTML($body);
			//echo $email;
			$mail->AddAddress($email);	// sending email to
			$mail->Send();
					$wpdb->query("insert into `sendmail_lordlinus`(`id`,`email`,`subject`,`body`,`sent`) values('','$email','$subject','$body','1')");	
			}
			//echo "Mailer Error: " . $mail->ErrorInfo;
			echo "<div class='alert alert-success'>Mail sent successfully</div>";
		}
	}
	?>
	<form  action="#" method="post">
	<strong>Enter Email Ids of your customers (Seperate them by comma (,) ) :</strong>
	<textarea name="emailid" id="emailid" class="span7" style="height:100px;"></textarea> <br/>
	<br/>
	<strong>Subject :</strong> &nbsp;&nbsp;&nbsp; <input type="text" name="subject" id="subject" class="span11" /><br/>
	<br/>
	<strong>Body : </strong>
	<?php
	the_editor('');
	?>
	<br/><br/>
	<input type="submit" class="btn btn-info" name="sendmail" value= "Send Mail" onclick="return check_values();" />
	</form>
	</div>
	
	
	</div>
	<?php
}
?>