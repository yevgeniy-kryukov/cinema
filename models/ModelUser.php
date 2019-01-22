<?php

class ModelUser extends Model
{

    public static function signIn($email, $password) 
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT id, pw FROM security.userapp WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $dataUser = $result->fetch();
        
        if (password_verify($password, $dataUser['pw'])) {
            return $dataUser['id'];
        }

        return false;
    }

    public static function isGoodPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function isGoodEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function isEmailExists($email)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT id FROM security.userapp WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetch() !== false) {
            return true;
        }

        return false;
    }

    public static function isAdmin($idUser)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT us.id FROM security.userapp AS us, security.roleapp AS rol 
                WHERE (us.roleapp = rol.id) AND (rol.name = 'admin') AND (us.id = :idUser)";

        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $result->execute();

        if ($result->fetch() !== false) {
            return true;
        }

        return false;
    }


    public static function signUp($email, $password) 
    {
        $pwHash = password_hash($password, PASSWORD_DEFAULT);
        
        $db = DataBase::getConnection();
        $sql = 'INSERT INTO security.userapp (email, pw) VALUES (:email, :pw)';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':pw', $pwHash, PDO::PARAM_STR);
        
        return $result->execute();
    }
}
