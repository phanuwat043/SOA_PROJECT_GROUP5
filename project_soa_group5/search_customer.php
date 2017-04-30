<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
      <link rel="stylesheet" type="text/css" href="css/form.css">
    <title></title>
  </head>
  <body>
    <h1 align="center">Search Customer</h1><br>

    <form class="" action="search_customer.php" method="post" align="center">
      <input type="text" name="name" placeholder="Search from name...">
      <input type="submit" name="enterName" value="Search"><br><br>
    </form>

    <?php
      $name = $_POST['name'];
      $uri = 'http://customerservices.azurewebsites.net/Customers/Search/CustomerName/'.$name;
      $reqPrefs['http']['method'] = 'GET';
      $stream_context = stream_context_create($reqPrefs);
      $response = file_get_contents($uri, false, $stream_context);
      $fixtures = json_decode($response,true);
    ?>


    <table align="center">
<tr align="center">
  <th>ID</th>
  <th>Title</th>
  <th>Firstname</th>
  <th>Lastname</th>
  <th>View Customer Detail</th>
  <th>View Order List</th>
</tr>

<?php
        error_reporting(0);
        foreach ($fixtures as $key => $row) {

               $cid = $row['CustomerID'];
               $title = $row['Title'];
               $fname = $row['FirstName'];
               $lname = $row['LastName'];

      ?>
         <?php if($cid>2000){ ?>
        <tr align="center">
          <td><?php echo $cid; ?></td>
          <td><?php echo $title; ?></td>
          <td><?php echo $fname; ?></td>
          <td><?php echo $lname; ?></td>
          <td><a href = "customer_detail.php?cid=<?php echo $cid; ?>" method ="post">View Customer Detail</a></td>
          <td><a href = "order_list.php?cid=<?php echo $cid; ?>" method ="post">View Order List</a></td>
        </tr>

      <?php
          }
        }
      ?>



</table>

 <br><form class="" action="index.php" method="post" align = "center">
      <input type="submit" name="" value="Back to Menu">
    </form>

  </body>
</html>
