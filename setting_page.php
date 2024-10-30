<h3>Email Setting:</h3>

<?php
if(isset($_POST['savesetting']))
{
	$host = $_POST['host'];
	$port = $_POST['port'];
	$emailid = $_POST['gemail'];
	$password = $_POST['password'];
	update_option('smtphostlord',$host);
	update_option('smtpportlord',$port);
	update_option('smtpemailord',$emailid);
	update_option('smtppasslord',$password);
	echo "<div class='alert alert-info'>Setting Updated Successfully</div>";
	
}
?>
<form action="#" method="post" class="detail-view table table-striped table-condensed">
<strong class="span3"> Host Name : </strong><input type="text" name="host" id="host" value="<?php echo get_option('smtphostlord');?>" required="required">
&nbsp; &nbsp; <strong> In case of GMAIL its (smtp.gmail.com)</strong>
<hr/>
<strong class="span3">Port No : </strong><input type="text" name="port" id="port" value="<?php echo get_option('smtpportlord');?>" required="required">
&nbsp;&nbsp; <strong> In case of GMAIL its (465) </strong>
<hr/>
<strong class="span3">GMail Id: </strong> <input type="email" name="gemail" id="gemail" value="<?php echo get_option('smtpemailord');?>" required="required"> 
&nbsp;&nbsp; Your Gmail Id
<hr/>
<strong class="span3">Gmail Password: </strong> <input type="password" name="password" value="<?php echo get_option('smtppasslord');?>" id="password" required="required">
&nbsp;&nbsp; This is on your server, We dont store any password on our server.
<hr/>
<strong class="span3"></strong>
<input type="submit" class="btn btn-primary" name="savesetting" value="Save setting">
</form>