<?php

class AdminService {

    public function serviceLogin(){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getAdminRepository();
        $admin = new Admin(array(
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        ));
        $result = $repo->checkAdmin($admin);

        if($result == true){
            echo("good");
        }

        else{
            echo("bad");
        }
    }
}

?>