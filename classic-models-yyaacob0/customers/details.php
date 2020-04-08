<?php
$title = "Customer information";
include "../templates/header.php";
include "../includes/functions.php";


echo "<table class=\"table\">";
echo "<thead>";
echo "    
<tr>
  <th>Customer Number</th>
  <th>Customer Name</th>
  <th>Contact Lastname</th>
  <th>Contact Firstname</th>
  <th>Phone</th>
  <th>Adress Line 1</th>
  <th>Adress Line 2</th>
  <th>City</th>
  <th>State</th>
  <th>Postal Code</th>
  <th>Country</th>
  <th>Sales Rep Employee Number</th>
  <th>Credit Limit</th>
  <th><button class=\"btn btn-link\" onclick=\"goBack();\">Back</button></th>
</tr>";
echo "</thead>";
echo "<tbody>";
showDetails("customers", "customers");
include "../templates/footer.php";