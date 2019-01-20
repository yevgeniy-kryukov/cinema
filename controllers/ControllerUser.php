<?php

class ControllerUser extends Controller
{
    public function actionSignin()
    {
        $errors = false;
        $email = '';
        
        if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
            $email = $_POST['inputEmail'];
            $password = $_POST['inputPassword'];

            if (!ModelUser::checkEmail($email)) $errors[] = "Invalid email.";

            if ($errors == false) {
                $idUser = ModelUser::signIn($email, $password);
                if ($idUser == false) {
                    $errors[] = "Incorrect  data for sign in.";
                } else {
                    header('Location:/');
                    $_SESSION['idUser'] = $idUser;
                    $_SESSION['emailUser'] = $email;                
                }
            }
        } 

        $dataView['signinEmail'] = $email;
        $dataView['signinErrors'] = $errors;

        View::generate('/user/signin.php', '/layouts/sign.php', $dataView);

        return true;
    }
   
    public function actionSignup()
    {
        $result = false;
        $errors = false;
        $email = '';

        if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
            $email = $_POST['inputEmail'];
            $password = $_POST['inputPassword'];

            if (!ModelUser::checkEmail($email)) $errors[] = "Invalid email.";
            if (ModelUser::isEmailExists($email)) $errors[] = "This email is already in use.";
            if (!ModelUser::checkPassword($password)) $errors[] = "Password must not be shorter than 6 characters.";

            if ($errors == false) {
                $result = ModelUser::signUp($email, $password);
                if ($result == false) $errors[] = "Error to write in database.";
            }
        }
        
        $dataView["signupEmail"] = $email;
        $dataView["signupResult"] = $result;
        $dataView["signupErrors"] = $errors;

        View::generate('/user/signup.php', '/layouts/sign.php', $dataView);

        return true;
    }
    
    public function actionSignout()
    {
        setcookie(session_name(), session_id(), time()-60*60*24, "/");
        session_unset();
        session_destroy();
        header('Location:/');
        
        return true;
    }
    
}
