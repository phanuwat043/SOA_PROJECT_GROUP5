<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/layout.css">
      <link rel="stylesheet" type="text/css" href="css/form.css">
    </head>
  <body>

       <h1 align="center">Product Detail</h1>

<div class="menu">
    <form action="order_list.php?oid=<?php echo $_GET["oid"];?>" name="frm" method="post">
      <?php
        error_reporting(0);
        $oid = $_GET['oid'];
        $uri = 'http://saleorderdetail.azurewebsites.net/OrderDetail/Search/SaleOrderID/'.$oid;
        $reqPrefs['http']['method'] = 'GET';
        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $fixtures = json_decode($response,true);
      ?>

      <table>
        <tr>
          <th>Product ID</th>
        </tr>
      </table>

      <?php
        error_reporting(0);
        foreach ($fixtures as $key => $row) {
  			       $pid = $row['ProductID'];
               $unitp = $row['UnitPrice'];
               $unitd = $row['UnitPriceDiscount'];
      ?>
      <ul>
        <li><a href="order_detail.php?pid=<?php echo $pid;?>"><?php echo "#".$pid; ?></a></li>
      </ul>
      <?php
        }
      ?>
</div>

<div class="main">
  <form action="order_detail.php?pid=<?php echo $_GET["pid"];?>" name="frm" method="post">
    <table>
      <tr>
        <th>Product Name</th>
        <th>Color</th>
        <th>Standard Cost</th>
        <th>Size</th>
        <th>Weight</th>
      </tr>

  <?php
    $pid = $_GET['pid'];
    $uri = 'http://977377searchproducts.azurewebsites.net/api/v1/Search/Products/'.$pid;
    $reqPrefs['http']['method'] = 'GET';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $fixtures = json_decode($response,true);
    //echo $fixtures['Name'];
  ?>

    <tr>
      <th><?php echo $fixtures['Name'];?></th>
      <th><?php echo $fixtures['Color']; ?></th>
      <th><?php echo $fixtures['StandardCost']; ?></th>
      <th><?php echo $fixtures['Size']; ?></th>
      <th><?php echo $fixtures['Weight']; ?></th>
    </tr>
  </table>
  <br>
  <input type="button" name="Cancel" value="Back to Menu" onclick="parent.location.href='index.php'" />
</div>
  </body>
</html>
