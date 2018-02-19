<?php

class Admin extends Model implements JsonSerializable {
    private $username;
    private $password;

    function setUsername($username) { $this->username = $username; }
    function getUsername() { return $this->username; }
    function setPassword($password) { $this->password = $password; }
    function getPassword() { return $this->password; }

    function jsonSerialize() {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "password" => $this->password
        ];
    }

}

?>