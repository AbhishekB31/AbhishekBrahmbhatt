<?php
  /**
  * Requires the "PHP Email Form" library
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  
  $receiving_email_address = 'abhishekbrahmbhatt31@gmail.com';

$db_host = 'local_host';
$db_user = 'root@localhost';
$db_name = 'contact_form_db'; // The name of the database you created

// Create a database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

$sql = "INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);

if ($stmt->execute()) {
   // Email sending code (uncomment if using SMTP)
   // ...

   echo "Message has been Sent!"; // This response will be processed by your JavaScript on the frontend.
} else {
   echo "Error"; // This response will be processed by your JavaScript on the frontend.
}

$stmt->close();
$conn->close();

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}else{
  echo "Database connection successful!";
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];
  $contact->message = $_POST['message'];


  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message($_POST['subject'],'Subject');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
  var_dump($_SERVER['REQUEST_METHOD']);
?>
