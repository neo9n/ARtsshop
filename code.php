<?php
session_start();

include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendMailVerify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    $smtpUsername = "mastermaxx2002@gmail.com";
    $smtpPassword = "nrdt pwnw vyvu bbkc";

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom($smtpUsername, $name);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Email verification";
        $mail->Body    = file_get_contents('VerificationEmail.php');

        if (!$mail->send()) {
            file_put_contents('error_log.txt', "Email could not be sent: " . $mail->ErrorInfo . "\n", FILE_APPEND);
            echo "Error: Email could not be sent. Please check the error log for details.";
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        file_put_contents('error_log.txt', "Exception occurred: " . $e->getMessage() . "\n", FILE_APPEND);
        echo "Error: Exception occurred. Please check the error log for details.";
        return false;
    }
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $cpw = $_POST['cpw'];
    $verify_token = md5(rand());


    if (empty($name)) {
?>
        <div class="alert alert-warning" role="alert">
            Please enter your name!
        </div>
    <?php
    } else if (empty($mobile)) {
    ?>
        <div class="alert alert-warning" role="alert">
            Please enter your Mobile number!
        </div>
    <?php
    } else if (empty($email)) {
    ?>
        <div class="alert alert-warning" role="alert">
            Please enter your Email!
        </div>
    <?php
    } else if (empty($pw)) {
    ?>
        <div class="alert alert-warning" role="alert">
            Please enter your Password!
        </div>
    <?php
    } else if (empty($cpw)) {
    ?>
        <div class="alert alert-warning" role="alert">
            Please retype Your password!
        </div>
    <?php
    } elseif ($pw != $cpw) {
    ?>
        <div class="alert alert-warning" role="alert">
            The passwords you entered doesn't match. <br> Please try again!
        </div>
<?php
    } else {
        $email_check_query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
        $email_check_query_run = mysqli_query($conn, $email_check_query);

        if (mysqli_num_rows($email_check_query_run) > 0) {
            $_SESSION['status'] = "Email Id already Exists";
            header("Location: register.php");
        } else {
            $query = "INSERT INTO user (name,email,mobile,password,user_type_id,verified_token,created_at) 
                          VALUES ('$name', '$email','$mobile','$pw','1','$verify_token','23:27:20')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                sendMailVerify($name, $email, $verify_token);
                $_SESSION['status'] = "<h3>Registration Successful!</h3> <br>  <h4>Please Verify your Email</h4>";
            } else {
                $_SESSION['status'] = "Registration Failed";
                // header("Location: register.php");
            }
        }
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
