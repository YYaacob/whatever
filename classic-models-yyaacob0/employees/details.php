<?php

$title = "Employee information";
include "../templates/header.php";
include "../includes/functions.php";


echo "<table class=\"table\">";
echo "<thead>";
echo "    
<tr>
  <th>Employee Number</th>
  <th>Lastname</th>
  <th>Firstname</th>
  <th>Extension</th>
  <th>Email</th>
  <th>Office code</th>
  <th>Reports to</th>
  <th>Job title</th>
  <th><button class=\"btn btn-link\" onclick=\"goBack();\">Back</button></th>
</tr>";
echo "</thead>";
echo "<tbody>";
showDetails("employees", "employees");
include "../templates/footer.php";