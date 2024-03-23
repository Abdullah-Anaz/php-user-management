<?php

require_once 'Repository/user.repository.php';

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function addUser($name, $email)
    {
        $result = $this->userRepository->addUser($name, $email);

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function deleteUser($user_id)
    {
        $result = $this->userRepository->deleteUser($user_id);

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function editUser($user_id, $name, $email)
    {
        $result = $this->userRepository->editUser($user_id, $name, $email);

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function getUser($user_id)
    {
        $result = $this->userRepository->getUser($user_id);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    public function getAllUsers()
    {
        $result = $this->userRepository->getAllUsers();

        if (!$result) {
            return null;
        }

        $userData = array();
        while ($row = mysqli_fetch_array($result)) {
            $userData[] = $row;
        }
        return $userData;
    }
}
