<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";

/* session_start();

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if(!$is_admin){
    http_response_code(401);
    die("Access denied");
} */

$success = false;

if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])){
    $upload_directory = __DIR__ . "/../assets/uploads/";
    $upload_name = basename($_FILES["image"]["name"]); //katt.jpeg
    $name_parts = explode(".", $upload_name); // ["katt", "jpeg"]
    $file_extension = end($name_parts); // "jpeg"
    $timestamp = time();  // "102030"
    $file_name = "{$timestamp}.{$file_extension}"; // "102030.jpeg"
    $full_upload_path = $upload_directory . $file_name;
    $full_relative_url = "/arthusen/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $product = new Product($_POST["title"], $_POST["description"], $_POST["price"], $full_relative_url);
        $products_db = new ProductsDatabase();
        $success = $products_db->create($product);
    }

}else{
    die("Invalid input");
}

if($success){
    header("Location: /arthusen/pages/admin.php");
    die();
}else{
    die("Error saving product");
}