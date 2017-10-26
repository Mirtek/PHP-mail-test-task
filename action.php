<?php
function send_mail_form(){
  
$to = $_POST['recipient-email']; 
//define the subject of the email 
$subject = 'from '.$_POST['name']; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 

$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: ".$_POST['email']."\r\nReply-To: ".$_POST['email']; 
//add boundary string and mime type specification 
$headers .= "\r\nMime-Version: 1.0 (1.0)\r\nContent-Type: multipart/mixed; charset=utf-8; boundary=\"PHP-mixed-".$random_hash."\"\r\n\r\n"; 

//read the atachment file contents into a string
//encode it with MIME base64,
//and split it into smaller chunks
$attachment = chunk_split(base64_encode(file_get_contents($_FILES['fileToUpload'][tmp_name]))); 
//define the body of the message. 
$message_name = $_POST['name'];

$filename= $_FILES['fileToUpload'][name];

ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="utf-8" 
Content-Transfer-Encoding: 8bit

Message from request form. From <?php echo $message_name ?>. 
Sender email is <?php echo $_POST['email'] ?>. 
Sender phone is <?php echo $_POST['phone'] ?>.
Sender meeting date is <?php echo $_POST['date'] ?>.


--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="utf-8" 
Content-Transfer-Encoding: 8bit


<h2>Message from request form. From <?php echo $_POST['name'] ?>.</h2> 
<p>Sender email is <?php echo $_POST['email'] ?>.</p> 
<p>Sender phone is <?php echo $_POST['phone'] ?>.</p>
<p>Sender meeting date is <?php echo $_POST['date'] ?>.</p>

--PHP-alt-<?php echo $random_hash; ?>-- 

--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: application/zip; name="<?php echo $filename ?>"  
Content-Transfer-Encoding: base64  
Content-Disposition: attachment  

<?php echo $attachment; ?> 
--PHP-mixed-<?php echo $random_hash; ?>-- 

<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed"; 
}
?>

<?php send_mail_form(); ?>.