<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
      <link rel="stylesheet" type="text/css" href="css/form.css">
  </head>
  <body>
    <h1 align="center">Order List</h1><br>
    <form action="search_customer.php?cid=<?php echo $_GET["cid"];?>" name="frm" method="post">

    <?php
      $cid = $_GET['cid'];
      //echo $cid;
      $uri = 'http://977377saleorderheader.azurewebsites.net/api/v1/salesOrderHeader/CustomerId/'.$cid;
      $reqPrefs['http']['method'] = 'GET';
      $stream_context = stream_context_create($reqPrefs);
      $response = file_get_contents($uri, false, $stream_context);
      $fixtures = json_decode($response,true);
    ?>

    <table align="center">
<tr align="center">
  <th>Order ID</th>
  <th>Order Date</th>
  <th>Ship Date</th>
  <th>Status</th>
  <th>View Order</th>
</tr>

<?php
        error_reporting(0);
        foreach ($fixtures as $key => $row) {
  			       $oid = $row['SalesOrderID'];
               $odate = $row['OrderDate'];
               $oshipdate = $row['ShipDate'];
               $ostatus = $row['Status'];
      ?>
        <tr align="center">
          <td><?php echo $oid; ?></td>
          <td><?php echo $odate; ?></td>
          <td><?php echo $oshipdate; ?></td>
          <td><?php echo $ostatus; ?></td>
          <td><a href = "order_detail.php?oid=<?php echo $oid;?>">View Order Detail</a></td>
        </tr>
      <?php
        }
      ?>



</table>
<br><input type="button" name="Cancel" value="Back to Menu" onclick="parent.location.href='index.php'"/>
  </body>
</html>
