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
    if (empty($email) || empty($pswd)) {
        echo json_encode(array("status" => 0, "message" => "Email or password is empty"));
        return;
    }

    $user = $dbConn->query("SELECT id, email, password FROM users where email='$email'");
    if ($user->rowCount() > 0) {
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
        //kiểm tra mật khẩu có đúng hay không
        if (password_verify($pswd, $password)) {
            //trả về thông tin user dưới dạng json
            echo json_encode(array(
                "status" => true,
                "id" => $id,
                "email" => $email
            ));
        } else {
            echo json_encode(array(
                "status" => false,
                "message" => "Mật khẩu không đúng"
            ));
        }
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "Email không tồn tại"
        ));
    }
} catch (Exception $th) {
    //throw $th;
    echo json_encode(array(
        "status" => false,
        "message" => $th->getMessage()
    ));
}
