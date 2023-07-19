<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../database/connection.php");

try {
    //code...
    $body = json_decode(file_get_contents("php://input"));
    $email = $body->email;
    $pswd = $body->password;
    $name = $body->name;
    if (empty($email) || empty($pswd) || empty($name)) {
        echo json_encode(array("status" => 400, "message" => "All fields are required"));
        return;
    }

    //kiểm tra email có tồn tại hay không
    $user = $dbConn->query("SELECT id, email, password FROM users where email='$email'");
    if ($user->rowCount() > 0) {
        echo json_encode(array("status" => 400, "message" => "Email is already taken"));
        return;
    } else {
        // mã hóa password
        $pswd = password_hash($pswd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (email, password, name) VALUES ('$email', '$pswd', '$name')";
        $result = $dbConn->query($sql);
        if ($result) {
            echo json_encode(array("status" => 200, "message" => "Register success"));
        } else {
            echo json_encode(array("status" => 400, "message" => "Register fail"));
        }
    }
} catch (Exception $th) {
    echo json_encode(array(
        "status" => false,
        "message" => $th->getMessage()
    ));
}
