<?php
if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  echo 'Please enter the captcha<br>';
  echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
  exit;
}
$secretKey = "6Lcc4VYUAAAAABIPfrMhRgmZj0IEY0Fr0zOunO0w";
$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
if(intval($responseKeys["success"]) !== 1) {
  echo 'Incorrect captcha<br>';
  echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
} else {
  
}

if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jenny@custommortgageandloans.com.au";
    $email_subject = "Custommortgageandloans contact";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
        echo "<br>";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['personname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');    
    }
 
     
 
    $personname = $_POST['personname']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['phone']; // required
    $comments = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$personname)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The message you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($personname)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Message: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.<br>
<a href="javascript:history.go(-1)">GO BACK</a>
 
<?php
 
}
?>