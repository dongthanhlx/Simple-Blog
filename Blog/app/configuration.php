<?php
require_once ('./includes/functions.php');
class configuration {
    private $json_data;
    private $mysqli_data;
    function __construct()
    {
        $json_content = file_get_contents(APP_DIR . 'app/config.json');
        $this->json_data = json_decode($json_content, true);
        $this->mysqli_data = $this->json_data['mysqli_connect'];
    }

    function getDBHost(){
        return $this->mysqli_data['host'];
    }

    function getDBUser() {
        return $this->mysqli_data['user'];
    }

    function getDBPassword() {
        return $this->mysqli_data['password'];
    }

    function getDBName() {
        return $this->mysqli_data['database'];
    }

    function getDBPort() {
        return $this->mysqli_data['port'];
    }
}