<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class DashboardRepository extends Repository
{
    //get profile from database from logged in user
    function getProfile($username)
    {
        try {
            $sql = "SELECT u.username, u.email, u.billing_info_id, b.billing_id, b.billing_name, b.billing_lastname, b.billing_phone, b.billing_address, b.billing_country 
            FROM `users` AS u 
            INNER JOIN `billing_info` AS b ON u.billing_info_id = b.billing_id 
            WHERE u.username = :username";            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');        
            $user = $stmt->fetch();
            if ($user) {
                return $user;
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //saves the profile with new inserted information in the form
    function saveProfile($username, $datauser)
    {
        try {
            $sql=("UPDATE billing_info SET billing_name = :firstname, billing_lastname = :lastname, billing_address = :address, billing_country = :country, billing_phone = :phonenumber 
            WHERE billing_id = (SELECT billing_info_id FROM users WHERE username = :username)");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $datauser["firstname"], PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $datauser["lastname"], PDO::PARAM_STR);
            $stmt->bindParam(':address', $datauser["address"], PDO::PARAM_STR);
            $stmt->bindParam(':country', $datauser["country"], PDO::PARAM_STR);
            $stmt->bindParam(':phonenumber', $datauser["phonenumber"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $user = $stmt->fetch();
            if ($user) {
                return $user;
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function changeEmail($username, $datauser)
    {
        try {
            $sql=("UPDATE users SET email = :email WHERE username = :username");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $datauser["email"], PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $user = $stmt->fetch();
            if ($user) {
                return $user;
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function changePassword($username, $datauser)
    {
        try {
            $sql=("");
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $user = $stmt->fetch();
            if ($user) {
                return $user;
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
}