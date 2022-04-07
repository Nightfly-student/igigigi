<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../models/billing.php';

class UserRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users, billing_info");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();
      
            return $users;
        } catch (PDOException $e) {
            echo 'Could not load users';
        }
    }

    public function getBillingInformation()
    {
        try {
            $sqlBilling = "SELECT * FROM billing_info";
            $stmt = $this->connection->prepare($sqlBilling);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Billing');

            $billing_information = $stmt->fetchAll();
            return $billing_information;
        } catch (PDOException $e) {
            echo 'Could not load Billing information.';
        }
    }
    
    function checkUserExist($username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username;");
            $stmt->execute([':username' => $username]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function checkUserEmailExist($username, $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username OR email = :email;");
            $stmt->execute([':username' => $username, ':email' => $email]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function createUser($username, $email, $password)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (role_id, username, email, password, billing_info_id) 
            VALUES (1, :username, :email, :password, 1);");
            $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password]);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function checkLogin($username, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE username= :username AND password= :password;");
            $stmt->execute([':username' => $username, ':password' => $password]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getSalt($username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT salt FROM users WHERE username= :username;");
            $stmt->execute([':username' => $username]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $salt = $stmt->fetchAll();

            return $salt;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getPassword($username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT password FROM users WHERE username= :username;");
            $stmt->execute([':username' => $username]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $password = $stmt->fetchAll();

            return $password;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    //Create Tickets / Invoices Check//
    function findUser($order_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT u.users_id, u.email, u.username, b.* FROM `orders` AS o 
            INNER JOIN `users` AS u ON u.users_id = o.users_id
            INNER JOIN `billing_info` AS b ON u.billing_info_id = b.billing_id 
            WHERE o.order_id = :order_id");
            $stmt->execute(array(':order_id' => $order_id));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                return $user;
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getRole($username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT users.role_id, role_name FROM users INNER JOIN role
            ON users.role_id = role.role_id WHERE users.username = :username;");
            $stmt->execute([':username' => $username]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $role = $stmt->fetchAll();

            return $role;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function changePassword($username, $password) {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET password = :password WHERE username = :username;");
            $stmt->execute([
                ':username' => $username,
                ':password' => $password
            ]);

            return 'Password is changed';

        } catch (PDOException $e)
        {
            return $e;
        }
    }
}
