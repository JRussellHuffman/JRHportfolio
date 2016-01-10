<?php
$field_name = $_POST['cf_name'];
$field_email = $_POST['cf_email'];
$field_message = $_POST['cf_message'];
$field_email = $_POST['cf_email'];
$field_message = $_POST['cf_message'];

$mail_to = 'jrussellhuffman@gmail.com';
$subject = 'Message from a site visitor '.$field_name;

$body_message = 'From: '.$field_name."\n";
$body_message .= 'E-mail: '.$field_email."\n";
$body_message .= 'Message: '.$field_message;

$headers = 'From: '.$field_email."\r\n";
$headers .= 'Reply-To: '.$field_email."\r\n";

//added for recaptcha
if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
	?>
	<script language="javascript" type="text/javascript">
  alert('Please check that you are not a spammer');
  window.location = 'index.html#contact';
  </script>
  <?php
  exit;
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeEHg0TAAAAAEKJaoNKxrH_AEIGoZ8YAPKj0MXM".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false) {
  echo '<h2>Captcha failed. Try again?</h2>';
}

//end recaptcha stuff
$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Thank you for the message. I will respond as quickly as possible. also, feel free to email me at JRussellHuffman@gmail.com');
		window.location = 'index.html#contact';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Message failed. Please send an email to jrussellhuffman@gmail.com');
		window.location = 'index.html#contact';
	</script>
<?php
}
?>