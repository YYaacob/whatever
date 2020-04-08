<?php
include_once "connect_db.php";

// checks if the table exists
function checkTable($table) {
  if(!isset($table)) {
    exit;
}
}

// gets a hash array with a given sql query
function SqlQuery($sql, $params = NULL) {
  try {
    global $db;
    $sth = $db->prepare($sql);
    $sth->execute($params);
    while($fetched = $sth->fetch(PDO::FETCH_ASSOC)) {
      if(isset ($fetched)) {
        $assocArray[] = $fetched;
        }
      }
      return $assocArray;
    } catch (PDOException $e)
    {
        echo "error: <br>" . $e->getMessage();
    }
  }

  // gets a key depending on the used table
function getKey($table){
  switch($table) {
    case "customers":
      $key = "customerNumber";
      break;
    case "employees":
      $key = "employeeNumber";
      break;
    case "offices":
      $key = "officeCode";
      break;
    case "productlines":
      $key = "productLine";
      break;
    case "products":
      $key = "productCode";
      break;
    default:
      $key = "";
      break;
  }
  return $key;
}

function showHeaders($table, $folder, $file) {
  $primaryKey = getKey($table);
  checkTable($table);
  try {
    $sqlQueryHashArray = SqlQuery("SELECT $primaryKey from `$table`");
    foreach($sqlQueryHashArray as $tableArray) {
      // echo "<pre>" . var_dump($key) . "</pre>";
      echo "<div class=\"card\">";
      echo "<div class=\"card-body\">";
      foreach($tableArray as $data) {
        // echo "<pre>" . var_dump($key) . "</pre>";
        echo "<div class=\"\">$data</div>";
      } 
      echo "<a class=\"card-link\" href=\"http://localhost/classic-models-yyaacob0/$folder/$file/?key=$data\">Details</a>";
      echo "<br />";
      echo "</div>";
      echo "</div>";
    }
  } catch(PDOException $err) {
    echo $sql . "<br />" . $err->getMessage();
  }
}

function showDetails($table, $folder) {
  $primaryKey = getKey($table);
  $key = $_GET["key"]; // gets the variable from the link sent in the show_headers() function.
  checkTable($table);
  try {
    $params = array(
      ":parameter" => $key
    );
    $sqlQueryHashArray = SqlQuery("SELECT * from `$table` WHERE $primaryKey = :parameter", $params);
    foreach($sqlQueryHashArray as $tableArray) {  // looping through my hash array
      echo "<tr>";
      foreach($tableArray as $data) {
        echo "<td>$data</td>";
      }
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='http://localhost/classic-models-yyaacob0/$folder/edit.php?key=$key'>Edit</a> <a href='#'>Delete</a>";
  } catch(PDOException $err) { // error handler
    echo $sql . "<br />" . $err->getMessage();
  }
}

function getDataInInputs($table) {
  $primaryKey = getKey($table); // this function gets keys for the tables
  $key = $_GET["key"];
  checkTable($table); // this checks if the table exists
  ?> 
  <form action="update.php" method="post">
  <?php 
  try {
    $params = array(
      ":parameter" => $key
    );
    $getAssocArray = SqlQuery("SELECT * from `$table` WHERE $primaryKey = :parameter", $params);
    foreach($getAssocArray as $b) {  // looping through my hash array
      echo "<tr>";
      foreach($b as $colName => $c) {
        
        echo "<td><input type='hidden' name='colNamen[]' value=\"$colName\"></td>";
        echo "<td><input type='text' name='record[]' value=\"$c\"></td>";
      }
      echo "</tr>";
    }
    echo "<input type='hidden' name='key' value=\"$key\">";
    echo "</tbody>";
    echo "</table>";
  } catch(PDOException $err) { // error handler
    echo $sql . "<br />" . $err->getMessage();
  }
  ?>
  <input type="submit" value="Update" name="updBtn">
  </form>

<?php 
}

 function updateData($table) {
  if(isset($_POST["updBtn"])) {
    global $db;
    $dataTable = empty($_POST["record"]) ? null : $_POST["record"];
    // echo "$dataTable[0]";
    foreach($dataTable as $data) {
      $rowValue = $data;
    }
    $getColNamen = empty($_POST["colNamen"]) ? null : $_POST["colNamen"];
    // echo "$getColNamen[0] is $dataTable[0]";
    
    foreach($getColNamen as $getColNaam) {
      $colNaam = $getColNaam;
    }
    // echo "<pre>" . var_dump($arr) . "</pre>";
    try {
      $sql = "UPDATE $table SET";
      $prep = $db->prepare($sql);
      $prep->execute();
      echo "Data modified correctly";
    } catch(PDOException $err) {
      echo $sql . "<br />" . $err->getMessage();
    } 
  }

 }

// function delete($table, $key) {
// do something
// }

// function insert() {
   // do something else
// }
?>
