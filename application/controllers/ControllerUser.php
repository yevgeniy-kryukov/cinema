<?php

class ControllerUser extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ModelUser();
    }
    
    public function actionSignin()
    {
        if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
            $email = $_POST['inputEmail'];
            $password = $_POST['inputPassword'];
            $res = $this->model->signIn($email, $password);
            if ($res > 0) {
                header('Location:/');
                $_SESSION['idUser'] = $res;
                $_SESSION['emailUser'] = $email;                
                $signinStatus = 'AccessGranted';
            } else {
                $signinStatus = 'AccessDenied';
            }
        } else {
            $signinStatus = "";
        }
        $dataView['signinStatus'] = $signinStatus;
        $this->view->generate('/user/signin.php', '/layouts/sign.php', $dataView);
    }
    
    public function actionSignup()
    {
        if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
            $email = $_POST['inputEmail'];
            $password = $_POST['inputPassword'];
            $res = $this->model->signUp($email, $password);           
            if ($res == 1) {
                header('Location:/signin');
                $signupStatus = 'SignupSuccess';
            } else if ($res == -1) {
                $signupStatus = 'EmailDuplicate';
            } else {
                $signupStatus = 'UnknownError';
            }
        } else {
            $signupStatus = '';
        }
        
        $dataView["signupStatus"] = $signupStatus;
        $this->view->generate('/user/signup.php', '/layouts/sign.php', $dataView);
    }
    
    public function actionSignout()
    {
        setcookie(session_name(), session_id(), time()-60*60*24, "/");
        session_unset();
        session_destroy();
        header('Location:/');
    }
    
}
