
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
    .zui-table {
  border: solid 1px #DDEEEE;
  border-collapse: collapse;
  border-spacing: 0;
  font: normal 13px Arial, sans-serif;
}
.zui-table thead th {
  background-color: #DDEFEF;
  border: solid 1px #DDEEEE;
  color: #336B6B;
  padding: 10px;
  text-align: left;
  text-shadow: 1px 1px 1px #fff;
}
.zui-table tbody td {
  border: solid 1px #DDEEEE;
  color: #333;
  padding: 10px;
  text-shadow: 1px 1px 1px #fff;
}
    </style>
  </head>
  <body class="jumbotron">
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
    $stmt = $dbh->getInstance()->prepare("SELECT * FROM products
      INNER JOIN productcategories ON products.ProductCategoryID = productcategories.ProductCategoryID
      WHERE SalonID='".$_SESSION['SalonID']."'");
    $stmt->execute();
    $Try=$stmt->fetch();
    echo "<h1>Add a new product<h1><br>";
    echo '<form method="POST" action="ConfirmProducts.php">
    <table class="zui-table">
    <tr>
    <th>Product Name</th>
    <th>Short Description</th>
    <th>Pices Available</th>
    <th>Price per unit</th>
    <th>Quantity of product(ml)</th>
    <th>Products Category</th>
    </tr>
    <tr>
    <td><input type="text" name="ProductName" required></td>
    <td><input type="text" name="ShortDescription" required></td>
    <td><input type="number" name="PicesAvailable" min="0" required></td>
    <td><input type="number" name="PricePerUnit" min="0" required></td>
    <td><input type="number" name="QuantityOfProduct" min="0" required></td>
    <td>
    <select name="ProductCategoryID" required>
    <option></option>';
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingProductCategories.php');
    foreach ($resultProductCategories as $key2 => $value2) {
    echo '<option value="'.$value2['ProductCategoryID'].'">' . $value2['ProductCategoryName'] . '</option>';
    }
    echo '
    </select></td>
    <td><button type="submit" name="Add">Add a new product</button></td>
    </tr>
    </table>
    </form>';

       if ($Try) {//if exist results
    echo "<h1>Edit existing products</h1><br>";
          echo "
        <table class='zui-table'><tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Short Description</th>
        <th>Pices Available</th>
        <th>Price per unit</th>
        <th>Quantity of product(ml)</th>
        <th>Products Category</th>
      </tr>";//print the values
      $stmt->execute();
      $row=$stmt;
          foreach ($row as $key => $value) {
            echo "<form method='post' action='ConfirmProducts.php'>";
            echo "<tr>";
            echo "<td>".$value['ProductID']."</td>";
            echo "<td>".$value['ProductName']."</td>";
            echo "<td>".$value['ShortDescription']."</td>";
            echo "<td>".$value['PicesAvailable']."Hrs</td>";
            echo "<td>".$value['PricePerUnit']."Min</td>";
            echo "<td>".$value['QuantityOfProduct']."</td>";
            echo "<td>".$value['ProductCategoryName']."</td>";
            echo "</tr>";
            //inputs
            echo '
            </tr>
            <tr>
            <td><input type="text" name="ProductID" value="'.$value['ProductID'].'" readonly></td>
            <td><input type="text" name="ProductName" ></td>
            <td><input type="text" name="ShortDescription" ></td>
            <td><input type="number" name="PicesAvailable" min="0" ></td>
            <td><input type="number" name="PricePerUnit" min="0" ></td>
            <td><input type="number" name="QuantityOfProduct" min="0" ></td>
            <td>
            <select name="ProductCategoryID">
            <option></option>';
            require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingProductCategories.php');
            foreach ($resultProductCategories as $key2 => $value2) {
            echo '<option value="'.$value2['ProductCategoryID'].'">' . $value2['ProductCategoryName'] . '</option>';
            }
            echo '
            </select></td>
            <td><input type="submit" value="Confirm Changes" name="Confirm"></td>
            <td><input type="submit" value="Delete Product" name="Delete"></td>
            </form>
            </tr>'


            ;}
          echo "</table>";

    }else{
      echo "No Products yet";
    }
    ?>
  </body>
</html>
