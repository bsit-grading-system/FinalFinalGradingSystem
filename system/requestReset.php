<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include ('config.php');


if(isset($_POST["email"])){

    $emailTo = $_POST["email"];

    $code = uniqid(true);
    $query = mysqli_query($con, "INSERT INTO resetpasswords(code, email) VALUES('$code', '$emailTo')");
    if(!$query) {
        exit("Error");
    }
    $mail = new PHPMailer(true);
    try {
        //Server settings
                             //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jamescanedo1@gmail.com';                     //SMTP username
        $mail->Password   = 'sasyzpyacjygdsuh';                               //SMTP password
        $mail->SMTPSecure = 'tls';                                     //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jamescanedo1@gmail.com', 'Grading System');
        $mail->addAddress("$emailTo");     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your Password reset link';
        $mail->Body    = "<h1>You Requested a password reset</h1>
                            Click this <a href='$url'>link</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        /*echo '<title>Request Link</title>
        <p style="color:rgba(5, 152, 98, 1); background:rgba(5, 152, 98,.2); padding:30px">
        Reset Password link has been sent to your email
        </p>
        <a href=""><button>OK</button>';*/
        
        
        echo '<script>alert("We have sent a link to your email to recover your account.");</script>

        
        <title>Request Link</title>
        <style>
                body{
                    margin:0;
                    padding:0;
                    font-family:arial;
                    background: rgba(247, 245, 255, 1);
                }
                form{
                    display:flex;
                    justify-content:center;
                }
                .boxs{
                    padding: 80px 20px;
                    background-color: rgba(253, 253, 253, 1);
                    margin-top: 40px;
                    border-radius: 10px;
                    box-shadow: 1px 1px 5px rgba(58, 41, 168,.2);
                    position: relative;
                    justify-content: center;
                    
                }
                .image{
                    justify-content: center;
                    margin-left: 130px;
                }
                img{
                    width: 100px;
                    position: absolute;
                    margin-top: -85px;
                    margin-left: -20px;
                    
                }
                .circle{
                    background: rgba(247, 245, 255, 1);
                    border-radius: 20px;
                    height: 100px;
                    width: 100px;
                    margin-top: -20px;
                    margin-left: -20px;
                }
                h3{
                   
                    font-weight: bold;
                    display: flex;
                    justify-content: center;
                }
                p{
                    margin-top: -14px;
                    font-size: 12px;
                    color: rgba(143, 143, 143, 1);
                }
                a{
                    text-decoration: none;
                    color: white;
                    justify-content: center;
                    display: flex;
                }
                button{
                    margin-top: 20px;
                    border: none;
                    height: 50px;
                    width: 233px ;
                    border-radius: 10px;
                    color: white;
                    background-color: rgba(136, 79, 238,1); 
                    cursor: pointer;
                    margin-left: 35px;
                    

                }
                button:hover{
                    background-color: rgba(123, 58, 237,1);
                    box-shadow: 1px 0px 5px rgba(123, 58, 237, 1);
                    outline: 2px solid rgba(123, 58, 237,1);
                }
        </style>
        <body>
                <form>
                    <div class="boxs">
                        <div class="image">
                            <div class="circle"></div>
                            <img src="envelope.svg">
                        </div>
                        <h3>Check your Email</h3>
                        <p>We have sent a link to your email to recover your account.</p>
                        <a href="https://gmail.com"><button type="submit" name="submit" ><a href="https://gmail.com">Open Gmail Account</a></button></a>
                    </div>
                </form>
        </body>
        
        ';
        
    } catch (Exception $e) {
        echo '<title><body style="padding:0; margin:0">Wrong Email Account</title><p style="color:rgba(226, 76, 34, 1); background:rgba(226, 76, 34,.2); padding:30px; font-size: 12px;font-family:sans-serif">Sorry, we could not find an account with that email. <a href="requestReset.php">Please try another account that already Registered in our System </a></p> </body>';
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Recover Account</title>
</head>
<body >
<form method="POST">
   <div class="box">
   <a href="login.php"><i class="fa fa-arrow-left" > </i><p>Back</p></a>
    <h5>Recover Account</h5>
    <span>Enter the email associated with your account <br>and we'll send an email with the link to <br>reset your password</span>
        <p class="e">Email Address</p>
        <input class="email"type="email" name="email" placeholder="Enter email" autocomplete="off" required >
        <br>
        <input class="button"type="submit" name="submit" value="Recover Account">
   </div>
        
   
        <style>
            body{
                background: rgba(247, 245, 255, 1);
                padding: 0;
                margin: 0;
                font-family: sans-serif;
            }
           
            form{
                display: flex;
                justify-content: center;
                
                
            }
            .box{
                padding: 80px 20px;
                background-color: rgba(253, 253, 253, 1);
                margin-top: 40px;
                border-radius: 10px;
                box-shadow: 1px 1px 5px rgba(58, 41, 168,.2);
                position: relative;
                
            }
            .email{
                border: 1px solid #ccc ;
                height: 35px;
                border-radius: 5px;
                outline: none;
                margin-right: 10px;
                width: 285px;
            }
            .email[placeholder]{
                padding-left: 10px;
                background-color: white;
               
                
            }
            .email[placeholder]:hover{
                color: rgba(58, 41, 168, .7);
            }
            .email:hover{
                outline: 1px solid rgba(58, 41, 168, .7);
            }
            .button{
                margin-top: 10px;
                outline: 1px solid rgba(123, 58, 237,1);
                background-color: rgba(136, 79, 238,1);  
                border: none;
                color: white;
                height: 40px;
                width: 300px;
                border-radius: 5px;
                cursor: pointer;
            }
            .button:hover{
                background-color: rgba(123, 58, 237,1);
                box-shadow: 1px 0px 5px rgba(123, 58, 237, 1);
                outline: 2px solid rgba(123, 58, 237,1);
            }
            i{
                position: absolute;
                margin-top: -50px;
            }
            h5{
                margin-top: -4px;

                font-size: 30px;
                
            }
            span{
                font-size: 13px;
                color: rgba(143, 143, 143, 1);
                margin-top: -40px;
              
                position: absolute;
                
                
            }
            a{
                color: black;
                text-decoration: none;
                display: flex;
                position: absolute;
            }
            a p{
                margin-top: -50px;
                margin-left: 20px;
            }
            a:hover{
                color: rgba(123, 58, 237,1);
            }
            .e{
                margin-top: 40px;
               position: absolute;
               font-size: 16px;
               color: rgba(143, 143, 143, 1);
               font-weight: 500;
            }
            input{
                margin-top: 60px;
            }
            
        </style>
</form>
</body>
</html>
