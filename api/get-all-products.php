<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../database/conection.php");
//

try {
    $product = $dbConn->query("SELECT Product.id, Product.name, Product.price, Product.quantity, Product.image, Product.description, Category.id as category_id, Category.name as category_name FROM products Product inner join categories Category on Product.categoryId = Category.id");
    $product = $product->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array(
        "status" => "success",
        "message" => "Products fetched successfully",
        "products" => $product
    ));
} catch (Exception $th) {
    echo json_encode(array(
        "status" => "error",
        "message" => $th->getMessage()
    ));
}
