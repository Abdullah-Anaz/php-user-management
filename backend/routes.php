<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once 'controller/user.controller.php';

$userController = new UserController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        switch ($_GET['action']) {
            case 'getUser':
                $userController->getUser();
                break;
            case 'getAllUsers':
                $userController->getAllUsers();
                break;
            default:
                echo json_encode(["success" => false, "message" => "Invalid action for GET request"]);
                break;
        }
        break;

    case 'POST':
        switch ($_GET['action']) {
            case 'addUser':
                $userController->addUser();
                break;
            default:
                echo json_encode(["success" => false, "message" => "Invalid action for POST request"]);
                break;
        }
        break;

    case 'PUT':
        switch ($_GET['action']) {
            case 'editUser':
                $userController->editUser();
                break;
            default:
                echo json_encode(["success" => false, "message" => "Invalid action for PUT request"]);
                break;
        }
        break;

    case 'DELETE':
        switch ($_GET['action']) {
            case 'deleteUser':
                $userController->deleteUser();
                break;
            default:
                echo json_encode(["success" => false, "message" => "Invalid action for DELETE request"]);
                break;
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Unsupported request method"]);
        break;
}
