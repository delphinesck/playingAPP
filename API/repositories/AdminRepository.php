<?php

class AdminRepository extends Repository {

    /* CHECK IF AN ADMIN EXISTS IN THE DATABASE */
    public function checkAdmin($admin){
        $pdo = $this->connection->prepare("SELECT * FROM admins WHERE username=:username AND upassword=:password");
        $pdo->execute(array(
            'username' => $admin->getUsername(),
            'password' => $admin->getPassword()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);

        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

}

?>