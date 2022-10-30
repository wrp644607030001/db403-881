<?php
   include 'db_connect.php';
?>
<?php
  $sql = " SELECT ProductName, UnitsInStock from products where CategoryID = 1 ";
  $result = $conn->query($sql);
  //$pro = mysqli_query( $conn, $sql );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
</head>
<body>
  <table >
    <tr>
      <th>Product name</th>
      <th>Units in stock</th>
    </tr>
    <tr>
        <?php
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ProductName']."</td>"; 
            echo "<td>".$row['UnitsInStock']."</td>";
            echo "</tr>"; 
          }
        ?>
  </tr>
  </table>
</body>
</html>