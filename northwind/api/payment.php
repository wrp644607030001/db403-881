<?php
session_start();
include '../db_connect.php';
$target_dir = '../images/slips/';
$target_file = $_SESSION['user']['cartID'].'.'.pathinfo(
    $_FILES['slip']['name'],
    PATHINFO_EXTENSION
);
move_uploaded_file($_FILES['slip']['tmp_name'], $target_dir.$target_file);
$conn->begin_transaction();
try {
    $sql = "DELETE FROM cart_details WHERE cartID={$_SESSION['user']['cartID']}";
    $conn->query($sql);
    $sql = "UPDATE cart SET slip='$target_file' WHERE cartID={$_SESSION['user']['cartID']}";
    $conn->query($sql);
    $conn->commit();
    unset($_SESSION['user']['cartID']);
}
catch(Exception $e) {
    echo "Error : {$e->getMessage()}"; // ให้แสดง error มาแสดง จะได้แก้ไขได้
    $conn->rollback();
}
header('location: ../index.php');
?>