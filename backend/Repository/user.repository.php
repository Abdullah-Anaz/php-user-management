<?php

require_once 'db.connection.php';

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance()->getConnection();
    }

    public function addUser($name, $email)
    {
        $name = mysqli_real_escape_string($this->db, $name);
        $email = mysqli_real_escape_string($this->db, $email);
        return mysqli_query($this->db, "INSERT INTO `user` (`name`, `email`) VALUES('$name', '$email')");
    }

    public function deleteUser($user_id)
    {
        $user_id = mysqli_real_escape_string($this->db, $user_id);
        return mysqli_query($this->db, "DELETE FROM `user` WHERE `user_id`='$user_id'");
    }

    public function editUser($user_id, $name, $email)
    {
        $user_id = mysqli_real_escape_string($this->db, $user_id);
        $name = mysqli_real_escape_string($this->db, $name);
        $email = mysqli_real_escape_string($this->db, $email);
        return mysqli_query($this->db, "UPDATE `user` SET `name`='$name', `email`='$email' WHERE `user_id` = $user_id");
    }

    public function getUser($user_id)
    {
        $user_id = mysqli_real_escape_string($this->db, $user_id);
        return mysqli_query($this->db, "SELECT * FROM `user` WHERE `user_id` = $user_id");
    }

    public function getAllUsers()
    {
        return mysqli_query($this->db, "SELECT * FROM `user`");
    }
}
