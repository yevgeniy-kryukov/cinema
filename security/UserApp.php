<?php
namespace cinema\security;

use cinema\util\{DataBase, Main};

class UserApp
{
    public static function signIn($email, $pw) 
    {
        $res = 0;    
        $result = DataBase::dbQuery(null, "SELECT id, pw FROM security.userapp WHERE email = $1", array($email));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);            
            if (password_verify($pw, $row["pw"])) {
                $res = 1;
                Main::sessionData("userID", $row["id"]);
                Main::sessionData("userEmail", $email);
            }
        } else {
            $res = -1;
        }
        return $res;
    }

    public static function signOut() 
    {
		setcookie(session_name(), session_id(), time()-60*60*24, "/");
	    session_unset();
		session_destroy();
		return 1;
    }

    public static function signUp($email, $pw) 
    {
        $res = 0;    
        $link = DataBase::dbConnect();
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
        pg_close($link);
        return $res;
    }
}

?>