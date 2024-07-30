<?php
session_start();

require("connections.php");
$email = "";
$name = "";
$errors = array();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Enable SMTP debugging. 0 for no debugging and 3 for showall debug 
$mail->SMTPDebug = 0;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password     
$mail->Username = "hcis.bahaypuso@gmail.com";
$mail->Password = "HCIS.bahaypuso";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;
//Email sender
$mail->From = "hcis.bahaypuso@gmail.com";
//Email sender name
$mail->FromName = "Bahay Puso Apostulate Foundation";
//Enable HTML
$mail->isHTML(true);

/* IF USER CLICK SIGN UP BUTTON */
if (isset($_POST['SignUp'])) {
    $name = ucwords(mysqli_real_escape_string($con, $_POST['fullname']));
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['inputPassword']);
    $cpassword = mysqli_real_escape_string($con, $_POST['passwordConfirm']);

    //check if email already registered up
    $query_emailcheck = "SELECT * FROM tbl_donor WHERE email = '$email'";
    $res = mysqli_query($con, $query_emailcheck);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you've entered already exist!";
    }
    if (count($errors) === 0) {
        $institution = NULL;
        $contact = NULL;
        $address = NULL;
        $encpass = password_hash($password, PASSWORD_DEFAULT);
        $code = rand(999999, 111111);
        $isVerified = 0;
        $status = "Active";
        $query_add = "INSERT INTO tbl_donor (fullname, institution, contact_number, address, email, password, code, isVerified, status) VALUES ('$name', '$institution', '$contact', '$address', '$email', '$encpass', '$code', $isVerified, '$status')";
        $data_check = mysqli_query($con, $query_add);

        //send OTP code via email
        if ($data_check) {
            $mail->Subject = "OTP Verification";
            $mail->Body = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
              <div style="border-bottom:1px solid #eee">
                <div style="font-size:1.4em;color: #00466a;font-weight:600">Bahay Puso Apostulate Foundation</div>
              </div>
              <p style="font-size:1.1em">Hi ' . $name . ',</p>
              <p>Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure.</p>
              <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $code . '</h2>
            </div>';
            $mail->AltBody = "Bahay Puso Apostulate Foundation" . "<br/><br/>" . "Hi " . $name . "<br/><br/>
            " . "Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure." . "<br/>" . $code;

            $mail->addAddress($email);

            if ($mail->send()) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                /* $_SESSION['password'] = $password; */
                header("Location: user-otp.php");
                exit();
            } else {
                $errors['otp-error'] = "Mailer Error: " . $mail->ErrorInfo;
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

/* IF USER CLICK VERIFY BUTTON */
if (isset($_POST['verify'])) {
    unset($_SESSION['err-header']);
    unset($_SESSION['info']);
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $query_codecheck = "SELECT * FROM tbl_donor WHERE code = $otp_code";
    $code_res = mysqli_query($con, $query_codecheck);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $isVerified = 1;
        $update_otp = "UPDATE tbl_donor SET code = $code, isVerified = $isVerified WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['success'] = 'success';
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: donation_login.php");
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

/* IF USER CLICK RESEND CODE BUTTON */
if (isset($_POST['resend'])) {
    //update otp in db
    $resend_email = mysqli_real_escape_string($con, $_POST['resend_email']);
    $resend_name = mysqli_real_escape_string($con, $_POST['resend_name']);
    $resend_code = rand(999999, 111111);
    $reset_otp = "UPDATE tbl_donor SET code = $resend_code WHERE email = '$resend_email'";
    $reset_otp_res = mysqli_query($con, $reset_otp);

    if ($reset_otp_res) {
        //resend OTP
        $mail->Subject = "OTP Verification";
        $mail->Body = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
              <div style="border-bottom:1px solid #eee">
                <div style="font-size:1.4em;color: #00466a;font-weight:600">Bahay Puso Apostulate Foundation</div>
              </div>
              <p style="font-size:1.1em">Hi ' . $resend_name . ',</p>
              <p>Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure.</p>
              <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $resend_code . '</h2>
            </div>';
        $mail->AltBody = "Bahay Puso Apostulate Foundation" . "<br/><br/>" . "Hi " . $resend_name . "<br/><br/>
            " . "Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure.." . "<br/>" . $resend_code;

        $mail->addAddress($resend_email);

        if ($mail->send()) {
            $info = "We've sent another a verification code to your email - $resend_email";
            $_SESSION['info'] = $info;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $resend_email;
            /*             $_SESSION['password'] = $password; */
            /* $counter = 30; */
            header("Location: user-otp.php");
            exit();
        } else {
            $errors['otp-error'] = "Mailer Error: " . $mail->ErrorInfo;
        }

        $info = "We've sent a verification code to your email - $email";
    }
}

//IF USER CLICK LOGIN BUTTON
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['login_email']);
    $password = mysqli_real_escape_string($con, $_POST['login_password']);
    $check_email = "SELECT * FROM tbl_donor WHERE email = '$email'";
    $login_res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($login_res) > 0) {
        $login_fetch = mysqli_fetch_assoc($login_res);
        $login_fetchpass = $login_fetch['password'];
        if (password_verify($password, $login_fetchpass)) {
            $_SESSION['email'] = $email;
            $isVerified = $login_fetch['isVerified'];
            if ($isVerified == 1) {
                $_SESSION['name'] = $login_fetch['fullname'];
                $_SESSION['email'] = $email;
                /* $_SESSION['password'] = $password; */
                header('location: donor/donation_index.php');
            } else {
                $info = "It's look like you haven't verify your email yet - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        } else {
            $_SESSION['email'] = $email;
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
    }
}

/* IF USER CLICK CONTINUE BUTTON ON FORGOT PASSWORD */
if (isset($_POST['continue'])) {
    $reset_email = mysqli_real_escape_string($con, $_POST['reset_email']);
    $reset_checkemail = "SELECT * FROM tbl_donor WHERE email='$reset_email'";
    $checkemail_res = mysqli_query($con, $reset_checkemail);
    if (mysqli_num_rows($checkemail_res) > 0) {
        $reset_data = mysqli_fetch_assoc($checkemail_res);
        $reset_name = $reset_data['fullname'];
        $reset_code = rand(999999, 111111);
        $insert_code = "UPDATE tbl_donor SET code = $reset_code WHERE email = '$reset_email'";
        $query_setcode =  mysqli_query($con, $insert_code);
        if ($query_setcode) {
            $mail->Subject = "OTP Verification";
            $mail->Body = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
              <div style="border-bottom:1px solid #eee">
                <div style="font-size:1.4em;color: #00466a;font-weight:600">Bahay Puso Apostulate Foundation</div>
              </div>
              <p style="font-size:1.1em">Hi ' . $reset_name . ',</p>
              <p>Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure.</p>
              <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $reset_code . '</h2>
            </div>';
            $mail->AltBody = "Bahay Puso Apostulate Foundation" . "<br/><br/>" . "Hi " . $reset_name . "<br/><br/>
            " . "Thank you for registration. The Bahay Puso Apostolate Foundation appreciates your generosity for your initiation on donating goods to our institution. Thank you for your kindness and generous support. Please use the OTP to continue your Sign-up procedure.." . "<br/>" . $reset_code;

            $mail->addAddress($reset_email);

            if ($mail->send()) {
                $info = "We've sent a password reset OTP to your email - $reset_email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $reset_email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

/* IF USER CLICK RESET-OTP BUTTON ON RESET CODE */
if (isset($_POST['reset-otp'])) {
    unset($_SESSION['err-header']);
    unset($_SESSION['info']);
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM tbl_donor WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password for your account.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

/* IF USER CLICK CHANGE BUTTON IN NEW PASSWORD */
if (isset($_POST['change-password'])) {
    unset($_SESSION['info']);
    $password = mysqli_real_escape_string($con, $_POST['updatePassword']);
    $cpassword = mysqli_real_escape_string($con, $_POST['passwordConfirm']);
    if ($password !== $cpassword) {
        $errors['password'] = "Password doesn't match!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_DEFAULT);
        $update_pass = "UPDATE tbl_donor SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            /* $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info; */
            $_SESSION['success'] = "reset success";
            header('Location: donation_login.php');
            die();
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}