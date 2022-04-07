<?php
//Anel
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/adminuser.php';
require __DIR__ . '/../models/billing.php';
require __DIR__ . '/../models/role.php';

class AdminUserRepository extends Repository
{
    public function getAllUsers()
    {
        try {
            $sqlUsers = "SELECT * FROM users INNER JOIN role ON users.role_id = role.role_id";
            // /INNER JOIN billing_info ON billing_info.billing_id = user.billing_info_id
            $stmt = $this->connection->prepare($sqlUsers);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdminUser');
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

    public function getRoles()
    {
        try {
            $stmt = $this->connection->prepare("SELECT role_id, role_name FROM role");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Role');

            $roles = $stmt->fetchAll();

            return $roles;
        } catch (PDOException $e) {
            echo 'Could not load roles.';
        }
    }

    public function updateUserOnly($user)
    {
        try {
            $sql = "UPDATE users SET username = :username, salt = :salt, password = :password, email = :email, 
                role_id = :roleId, billing_info_id = :billingId WHERE users_id = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':username' => $user->getUsername(), ':salt' => $user->getSalt(), ':password' => $user->getPassword(),
                ':email' => $user->getEmail(), ':roleId' => $user->getUserRoleId(), ':billingId' => null,
                ':userId' => $user->getUserId()
            ]);

            return json_encode(['passed' => true, 'message' => 'The user is updated.']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'The user could not be updated, try again.']);
        }
    }

    public function updateUserAddBilling($user)
    {
        try {
            //update user and create new billing
            $billingInfo = $user->getBillingInfo();
            $sql = "INSERT INTO billing_info (billing_name, billing_lastname, billing_phone, billing_address, billing_country)
                            VALUES (:name, :lastname, :phone, :address, :country)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':name' => $billingInfo->getName(), ':lastname' => $billingInfo->getLastname(),
                ':phone' => $billingInfo->getPhone(), ':address' => $billingInfo->getAddress(), ':country' => $billingInfo->getCountry()
            ]);
            $lastId = $this->connection->query("SELECT LAST_INSERT_ID()");
            $billingId = $lastId->fetchColumn();

            $sql = "UPDATE users SET username = :username, salt = :salt, password = :password, email = :email, 
                        role_id = :roleId, billing_info_id = :billingId WHERE users_id = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':username' => $user->getUsername(), ':salt' => $user->getSalt(), ':password' => $user->getPassword(),
                ':email' => $user->getEmail(), ':roleId' => $user->getUserRoleId(), ':billingId' => $billingId,
                ':userId' => $user->getUserId()
            ]);

            return json_encode(['passed' => true, 'message' => 'The user is updated, billing is created for user.']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'The user could not be updated, try again.']);
        }
    }

    public function updateUserDeleteBilling($user)
    {
        try {
            $sql = "UPDATE users SET username = :username, salt = :salt, password = :password, email = :email, 
            role_id = :roleId, billing_info_id = :billingId WHERE users_id = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':username' => $user->getUsername(), ':salt' => $user->getSalt(), ':password' => $user->getPassword(),
                ':email' => $user->getEmail(), ':roleId' => $user->getUserRoleId(), ':billingId' => null,
                ':userId' => $user->getUserId()
            ]);

            $stmt = $this->connection->prepare("DELETE FROM billing_info WHERE billing_id = :id");
            $stmt->execute([':id' => $user->getBillingId()]);

            return json_encode(['passed' => true, 'message' => 'User is updated, billing information is deleted.']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'The user could not be updated, try again.']);
        }
    }

    public function updateUserAndBilling($user)
    {
        try {
            $sql = "UPDATE users SET username = :username, salt = :salt, password = :password, email = :email, 
                role_id = :roleId, billing_info_id = :billingId WHERE users_id = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':username' => $user->getUsername(), ':salt' => $user->getSalt(), ':password' => $user->getPassword(),
                ':email' => $user->getEmail(), ':roleId' => $user->getUserRoleId(), ':billingId' => $user->getBillingId(),
                ':userId' => $user->getUserId()
            ]);

            $billing = $user->getBillingInfo();

            $sql = "UPDATE billing_info SET billing_name = :name, billing_lastname = :lastname, billing_phone = :phone, billing_address = :address, billing_country = :country WHERE billing_id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':name' => $billing->getName(), ':lastname' => $billing->getLastname(),
                ':phone' => $billing->getPhone(), ':address' => $billing->getAddress(),
                ':country' => $billing->getCountry(), ':id' => $billing->getId()
            ]);
            return json_encode(['passed' => true, 'message' => 'The user and billing information has been updated.']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateUser($user)
    {
        try {
            $existingUserBilling = $this->getBillingById($user->getBillingId());
            //$existingUser = $this->getUserById($user->getUserId());

            if ($user->getBillingInfo() == null && $existingUserBilling == false) {
                //update without billing info
                return $this->updateUserOnly($user);
            }
            if ($user->getBillingInfo() == null && $existingUserBilling != false) {
                //update user and delete existing billing information
                return $this->updateUserDeleteBilling($user);
            }

            if ($user->getBillingInfo() != null && $existingUserBilling != false) {
                // update user + billing both are existing
                return $this->updateUserAndBilling($user);
            }

            if ($user->getBillingInfo() != null && $existingUserBilling == false) {
                //Create billing, and update the user.
                return $this->updateUserAddBilling($user);
            }
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'The user could not be updated, try again later.']);
        }
    }

    public function createUser($user)
    {
        try {
            $billingId = null;
            if ($user->getBillingInfo() != null) {
                $sql = "INSERT INTO billing_info (billing_name, billing_lastname, billing_phone, billing_address, billing_country) 
                VALUES (:name, :lastname, :phone, :address, :country)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([
                    ':name' => $user->getBillingInfo()->getName(), ':lastname' => $user->getBillingInfo()->getLastname(),
                    ':phone' => $user->getBillingInfo()->getPhone(), ':address' => $user->getBillingInfo()->getAddress(),
                    ':country' => $user->getBillingInfo()->getCountry()
                ]);

                $latestId = $this->connection->query("SELECT LAST_INSERT_ID()");
                $billingId = $latestId->fetchColumn();
            }
            $sql = "INSERT INTO users (role_id, billing_info_id, email, password, salt, username) VALUES (:roleid, :billingid, :email, :pass, :salt, :username)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':roleid' => $user->getUserRoleId(), ':billingid' => $billingId, ':email' => $user->getEmail(),
                ':pass' => $user->getPassword(), ':salt' => $user->getSalt(), ':username' => $user->getUsername()
            ]);

            return json_encode(['passed' => true, 'message' => 'User was created successfully. ']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'Something went wrong the user could not be updated. Try again']);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->connection->prepare("SELECT * FROM users WHERE users_id = :id");
            $user->execute([':id' => $id]);
            $user->setFetchMode(PDO::FETCH_CLASS, 'AdminUser');
            $user = $user->fetchObject();

            //Won't work if Billing Id's are not unique for users in the DB!
            if ($user != false && is_numeric($user->billing_info_id)) {
                $stmt = $this->connection->prepare('DELETE users, billing_info FROM users INNER JOIN billing_info 
                ON billing_info.billing_id = users.billing_info_id WHERE users.users_id = :id');
                $stmt->execute([':id' => $id]);
                return json_encode(['passed' => true, 'message' => 'The user is being deleted..']);
            } elseif ($user != false && $user->billing_info_id == false) {
                $stmt = $this->connection->prepare('DELETE users FROM users WHERE users.users_id = :id');
                $stmt->execute([':id' => $id]);
                return json_encode(['passed' => true, 'message' => 'The user is being deleted..']);
            }
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'The user could not be deleted.']);
        }
    }

    public function checkIfUsernameIsTaken($username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);

            $result = ($stmt->rowCount() > 0) ? true : false;
            return $result;
        } catch (PDOException $e) {
            return 'Something went wrong when validating username.';
        }
    }

    public function checkIfEmailIsTaken($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);

            $result = ($stmt->rowCount() > 0) ? true : false;
            return $result;
        } catch (PDOException $e) {
            return 'Something went wrong when validating username.';
        }
    }

    public function checkIfUserExists($id)
    {
        $stmt = $this->connection->prepare("SELECT users_id FROM users WHERE users_id = :id");
        $stmt->execute([':id' => $id]);
        $results = $stmt->rowCount();
        if ($results > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE users_id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdminUser');
            $user = $stmt->fetchObject();

            if ($user->billing_info_id != null) {
                $user->billingInfo = $this->getBillingById($user->billing_info_id);
            }
            return $user;
        } catch (PDOException $e) {
            echo 'Something went wrong could not find user.';
        }
    }

    public function getBillingById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM billing_info WHERE billing_id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Billing');
            $billing = $stmt->fetchObject();
            return $billing;
        } catch (PDOException $e) {
            echo 'Something went wrong could not find billing information.';
        }
    }
}
