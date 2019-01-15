<?php

class ModelUser extends Model
{
    public function signIn($email, $password) 
    {
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT id, pw FROM security.userapp WHERE email = $1', array($email));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);            
            if (password_verify($password, $row['pw'])) {
                return $row['id'];
            }
        } 
        return false;
    }

    public function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkEmailExists($email)
    {
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT id FROM security.userapp WHERE email = $1', array($email));
        if (pg_num_rows($result) > 0) {
            return true;
        } 
        return false;
    }

    public function signUp($email, $password) 
    {
        $link = DataBase::dbConnect();
        $pwHash = password_hash($password, PASSWORD_DEFAULT);
        $result = DataBase::dbQuery($link, 'INSERT INTO security.userapp (email, pw) VALUES ($1, $2)', array($email, $pwHash));
        if (pg_affected_rows($result) > 0) {
            return true;
        }
        return false;
    }
}
