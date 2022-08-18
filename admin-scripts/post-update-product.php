<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_GET["id"])){
    $upload_directiory = __DIR__ . "/../assets/uploads/";
    $name_parts = explode(".", $upload_name);
    $file_extension = end($name_parts);
    $timestamp = time();
    $file_name = "{$timestamp}.{$file_extension}";
    $full_upload_path = $upload_directiory . $file_name;
    $full_relative_url = "/arthusen/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $product = new Product($_POST["title"], $_POST["description"], $_POST["price"], $full_relative_url);
        $products_db = new ProductsDatabase();
        $success = $products_db->update($product, $_GET["id"]);
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