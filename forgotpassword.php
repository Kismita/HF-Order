<?php
    require("connection.php");
    require ('updatepassword.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    function sendMail($email,$reset_token)
    {
        require ( 'PHPMailer/PHPMailer.php' );
        require ( 'PHPMailer/SMTP.php' );
        require ( 'PHPMailer/Exception.php' );

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sujataadhikari372@gmail.com';                     //mail aaune actual email              
            $mail->Password   = 'bfxqvhwfziyxeicp';                               //tei email ko actual password                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('sujataadhikari372@gmail.com', 'Sujata Adhikari'); //mathiko email ra username
            $mail->addAddress($email,$uname);                        //receiver's mail

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password reset link';
            $mail->Body    = "This is the reset password link for you.<br/>
                                Click the link below <br/>
                                <a href='localhost/code/loginSystem/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    if(isset($_POST['send-reset-link']))
    {
        $query="SELECT * FROM `registered_users` WHERE `email`='$_POST[email]'";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                // email found
                $reset_token=bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/Kolkata');
                $date=date("Y-m-d");
                //copy from database
                $query="UPDATE `registered_users` SET `resettoken`='$reset_token', `resettokenexpire`='$date' WHERE `email`='$_POST[email]' ";
                if(mysqli_query($con,$query) && sendMail($_POST['email'],$reset_token))
                {
                    echo "
                    <script>
                        alert('Password reset link is sent to your mail!');
                        window.location.href='index.php';
                    </script>
                    ";
                }else{
                    echo "
                <script>
                    alert('Cannot send link,please try again!');
                    window.location.href='index.php';
                </script>
                ";

                }

            }else{
                echo "
                <script>
                    alert('Provided email is invalid!');
                    window.location.href='index.php';
                </script>
                ";
            }

        }else{
            echo "
            <script>
            alert('invalid query');
            window.location.href='index.php';
            </script>
            ";
        }
    }

    //go to database and set NULL in resettoken and resettokenexpire

    

?>