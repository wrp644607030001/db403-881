<?php
    session_start();
    include '../db_connect.php';        // [ .. คือ up ขึ้นไปอยู่บนโฟลเดอร์ ]
    $conn->begin_transaction();         // [ begin_transaction() = ยังไม่บันทึกลงไปใน DB จริงๆ ]
    try {
        if(!isset($_SESSION['user']['cartID'])) {
            $sql = "INSERT into cart(email) values ('{$_SESSION['user']['email']}')";
            $conn->query($sql);
            $_SESSION['user']['cartID'] = $conn->insert_id;     // [ คำสั่ง insert_id = insert id ตัวล่าสุดพื่อรันนัมเบอร์ต่อไป ]
        }
        $sql = 'INSERT into cart_details(cartID, ProductID, Units) values(?, ?, 1) on duplicate key update Units=Units+1';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['user']['cartID'], $_GET['ProductID']);
        $stmt->execute();
        $stmt->close();

        $conn->commit();                        // [ ถ้าไม่ error ให้ commit ]
    }
    catch(Exception $e) {
        echo "Error : {$e->getMessage()}";      // ให้แสดง error มาแสดง จะได้แก้ไขได้
        $conn->rollback();                      // [ ถ้า error ให้ rollback กลับมาเหมือนเดิมไม่มีอะไรเกิดขึ้น ]
      }
$conn->close();
header("location: ../product.php?category={$_GET['category']}");
?>