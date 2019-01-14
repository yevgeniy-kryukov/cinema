<?php

class ModelUser extends Model
{
    public function signIn($email, $pw, $link = null) 
    {
        $res = 0;    
        $result = DataBase::dbQuery($link, "SELECT id, pw FROM security.userapp WHERE email = $1", array($email));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);            
            if (password_verify($pw, $row["pw"])) {
                $res = $row["id"];
            }
        } else {
            $res = -1;
        }
        return $res;
    }

    public function signUp($email, $pw, $link = null) 
    {
        $res = 0;    
        $result = DataBase::dbQuery($link, "SELECT id FROM security.userapp WHERE email = $1", array($email));
        if (pg_num_rows($result) == 0) {
            $pwHash = password_hash($pw, PASSWORD_DEFAULT);
            $resultIns = DataBase::dbQuery($link, "INSERT INTO security.userapp (email, pw) VALUES ($1, $2)", array($email, $pwHash));
            if (pg_affected_rows($resultIns) > 0) {
                $res = 1;
            }
        } else {
            $res = -1;
        }
        return $res;
    }
}
