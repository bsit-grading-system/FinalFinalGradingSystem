<?php
//custom functions and configurations for twilio
require_once "functions.php";
if (!empty($_POST['phone']) && !empty($_POST['message'])) {

  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $attempt = sendSMS($message, $phone);
  dump($attempt);
}

?>
<!-- 
<form action="" method="post">
  <label for="">Phone number</label><br>
  <input type="text" name="phone" required>

  <br><br>
  <label for="">Message</label><br>
  <textarea name="message" id="" cols="80" rows="2" required></textarea>

  <br><br>
  <input type="submit" value="Send">
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send Message</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
</head>

<body>
  
  <form action="" method="post">
    <label for="">Phone number</label><br>
    <input type="text" name="phone" placeholder="+63" required>

    <br><br>
<label for="message">Your Message</label><br>
<textarea name="message" id="" cols="40" rows="5" required>
Dear Student,

We are pleased to inform you that your grades for the recent quaters are now available for viewing. 
You can access your grades by logging into the student portal.
Please log in at your earliest convenience to review your grades and academic performance. 
If you have any questions or concerns regarding your grades, don't hesitate to reach out to the academic office.

Best regards,
Engr. Ryan H. Teo
</textarea>


    <br><br>
    <button type="submit">
  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0h24v24H0z" fill="none"></path>
        <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
      </svg>
    </div>
  </div>
  <span>Send</span>
</button>
  </form>
</body>

</html>