<?php
define('DB_SERVER', 'localhost');
define('DB_NAME', 'SPORTS_MANAGEMENT');
$checkdb=array
  (
  array("U","user",123456),
  array("A","admin",123456),
  array("M","manager",123456),
  array("P","player",123456)

  );

if($_SESSION['type'] === $checkdb[0][0]){

  define('DB_USERNAME', $checkdb[0][1]);
  define('DB_PASSWORD', $checkdb[0][2]);

}
elseif($_SESSION['type'] === $checkdb[1][0]){

  define('DB_USERNAME', $checkdb[1][1]);
  define('DB_PASSWORD', $checkdb[1][2]);


}
elseif($_SESSION['type'] === $checkdb[2][0]){

  define('DB_USERNAME', $checkdb[2][1]);
  define('DB_PASSWORD', $checkdb[2][2]);



}
elseif($_SESSION['type'] === $checkdb[3][0]){

  define('DB_USERNAME', $checkdb[3][1]);
  define('DB_PASSWORD', $checkdb[3][2]);
}


?>
