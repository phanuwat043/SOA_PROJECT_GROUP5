<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
      <link rel="stylesheet" type="text/css" href="css/form.css">
    <title></title>
  </head>
  <body>
    <h1 align = "center">Customer Detail</h1><br>

    
    <?php
      $cid = $_GET['cid'];
     

      //From URI 1
      $uri = 'http://customerservices.azurewebsites.net/Customers/Search/CustomerID/'.$cid;
      $reqPrefs['http']['method'] = 'GET';
      $stream_context = stream_context_create($reqPrefs);
      $response = file_get_contents($uri, false, $stream_context);
      $fixtures = json_decode($response,true);

      //From URI 2
      $uri2 = 'http://977-377demoapi.azurewebsites.net/api/CustomerAddresses/'.$cid;
      $reqPrefs2['http']['method'] = 'GET';
      $stream_context2 = stream_context_create($reqPrefs2);
      $response2 = file_get_contents($uri2, false, $stream_context2);
      $fixtures2[] = json_decode($response2,true);

      error_reporting(0);
      //Use CustomerID for get CustomerDetail
        foreach ($fixtures as $key => $row) {
               $title = $row['Title'];
               $fname = $row['FirstName'];
               $lname = $row['LastName'];
               $company = $row['CompanyName'];
               $sale = $row['SalesPerson'];
               $email = $row['EmailAddress'];
               $phone = $row['Phone'];

      }?>
               <table border="1" align ="center">
               <tr>
                <th>
               <?php
               echo 'Title :'.$title;echo '<br>';
               echo 'FirstName :'.$fname;echo '<br>';
               echo 'LastName :'.$lname;echo '<br>';
               echo 'Company Name :'.$company;echo '<br>';
               echo 'Sale Person :'.$sale;echo '<br>';
               echo 'Email :'.$email;echo '<br>';
               echo 'Phone :'.$phone;echo '<br>';
               ?>
               
                
                <?php
                //For get AddressID
                foreach ($fixtures2 as $key2 => $row2) {
               $addrid = $row2['AddressID'];
               

      }
               ?>
                </th>
                <th>
               <?php
              //Right part  
              if($addrid != null){
             //URI adrressID get address
              $uri3 = 'http://977-377demoapi.azurewebsites.net/api/v1/address/search/'.$addrid;
              
              
              //From URI 3
              $reqPrefs3['http']['method'] = 'GET';
              $stream_context3 = stream_context_create($reqPrefs3);
              $response3 = file_get_contents($uri3, false, $stream_context3);
              $fixtures3[] = json_decode($response3,true);


               foreach ($fixtures3 as $key3 => $row3) {
               $addr1 = $row3['AddressLine1'];
               $city = $row3['City'];
               $state = $row3['Washington'];
               $postal = $row3['PostalCode'];
               

      }
                  
               

               echo 'AddressID :'.$addrid;echo '<br>';
               echo 'AddressLine1 :'.$addr1;echo '<br>';
               echo 'City :'.$city;echo '<br>';
               echo 'State Province :'.$state;echo '<br>';
               echo 'Postal Code :'.$postal;echo '<br>';
              
              

               }
               ?>
             </th>
           </font>
             </tr>
              </table>
       
   <br><form class="" action="index.php" method="post" align = "center">
      <input type="submit" name="" value="Back to menu">
    </form>   
  </body>
</html>