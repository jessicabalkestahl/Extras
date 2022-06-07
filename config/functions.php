<?php

    date_default_timezone_set("Europe/Lisbon");

    require_once "./config/database.php";

    function verifyUser($username, $password){
       
        $sql = "SELECT * FROM workers WHERE username='$username' AND password='$password'";
        $user = select_one_SQL($sql);

        if(!empty($user)){

            session_start();
            $_SESSION["user"] = $user;

            $date = date("H:i:s - d/m/Y");
            $id = $user["id"];

            $sql = "UPDATE workers SET last_access='$date' WHERE id=$id";
            idu_SQL($sql);

            return true;
        }
        else{
            return false;
        }
    }

    function newUser($username, $password){
        $date_created = date("H:i:s - d/m/Y");

        $sql = "INSERT INTO workers (username, password, date_created) VALUES ('$username', '$password', '$date_created')";
        idu_SQL($sql);
    }

    function verifyLogin(){
        
        session_start();
        
        if(!empty($_SESSION["user"])){
            return true;
        }
        else{
            return false;
        }
    }

    function logout(){

        session_start();
        session_destroy();
    }

    function encryptPassword($password){
        $password_encrypted = password_hash($password, PASSWORD_DEFAULT);

        return $password_encrypted;
    }

    function getData(){
        $sql = "SELECT * FROM imprensa ORDER BY id DESC";
        $data = select_SQL($sql);

        return $data;
    }

    function getTotalPages(){
        $elem_per_page = 2;

        $sql = "SELECT id FROM imprensa";

        $results = select_SQL($sql);
        $t_elem = count($results);
        $t_pages = ceil($t_elem / $elem_per_page);

        return $t_pages;
    }

    function getPosts($page){
        $elem_per_page = 2;
        $postagens = getData();

        $inicio = ($page - 1) * $elem_per_page;
        
        // $final = $inicio + ($elem_per_page - 1);
        // $resultados = [];
        // for($i = $inicio; $i <= $final; $i++){
        //     $resultados[] = $postagens[$i];
        // }

        $posts = array_splice($postagens, $inicio, $elem_per_page);

        return $posts;
    }

?>