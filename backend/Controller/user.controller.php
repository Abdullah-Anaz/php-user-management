<?php

require_once 'Service/user.service.php';

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function addUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name) && isset($data->email) && !empty(trim($data->name)) && !empty(trim($data->email))) {
            $result = $this->userService->addUser($data->name, $data->email);
            if ($result) {
                echo json_encode(["success" => true, "message" => "User Added Successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Unsuccessful Insertion!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid data"]);
        }
    }

    public function deleteUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->user_id) && is_numeric($data->user_id)) {
            $result = $this->userService->deleteUser($data->user_id);

            if ($result) {
                echo json_encode(["success" => true, "message" => "User Deleted"]);
            } else {
                echo json_encode(["success" => false, "message" => "User Not Found!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid user ID"]);
        }
    }

    public function editUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->user_id) && !empty(trim($data->user_id)) && isset($data->name) && isset($data->email) && !empty(trim($data->name)) && !empty(trim($data->email))) {
            $result = $this->userService->editUser($data->user_id, $data->name, $data->email);
            if ($result) {
                echo json_encode(["success" => true, "message" => "User Updated Successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Unsuccessful Update!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid data"]);
        }
    }

    public function getUser()
    {
        $user_id = $_GET['user_id'];
        if (isset($user_id) && !empty(trim($user_id))) {
            $result = $this->userService->getUser($user_id);

            if ($result) {
                echo json_encode(["success" => true, "message" => "User Found Successfully", "user" => $result]);
            } else {
                echo json_encode(["success" => false, "message" => "User Not Found"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid user ID"]);
        }
    }

    public function getAllUsers()
    {
        $result = $this->userService->getAllUsers();

        if ($result) {
            echo json_encode(["success" => true, "userlist" => $result]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
}
