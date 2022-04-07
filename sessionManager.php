<?php
    session_start();

    function checkLogin(){
        if(isset($_SESSION['username']) && $_SESSION['role'] == 'customer')
            return true;
        else 
            return false;
    }
   
    function checkAdminLogin(){
        if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin')
            return true;
        else
            return false;
    }
    function checkSuperAdminLogin(){
        if(isset($_SESSION['username']) && $_SESSION['role'] == 'superadmin')
            return true;
        else
            return false;
    }

    function logout(){
        session_destroy();
    }
?>