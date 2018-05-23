<?php
// create short variable names
$name       = (int) $_POST['name_ID'];  // Database unique ID for player's name
$time       = trim( preg_replace("/\t|\R/",' ',$_POST['time']) );

$points     = (int) $_POST['points'];
$assists    = (int) $_POST['assists'];
$rebounds   = (int) $_POST['rebounds'];
$three_points  = (int) $_POST['three_points'];
$block  = (int) $_POST['block'];
$foul  = (int) $_POST['foul'];
$ftm  = (int) $_POST['ftm'];
$FTA  = (int) $_POST['FTA'];
$STEAL  = (int) $_POST['steal'];
$gameid = (int)$_POST['GAMEID'];
// echo "
if( empty($name)     ) $name      = null;
// see below for $time processing
if( empty($points)   ) $points    = 0;
if( empty($assists)  ) $assists   = 0;
if( empty($rebounds) ) $rebounds  = 0;
if( empty($three_points)     ) $three_points      = 0;
// see below for $time processing
if( empty($block)   ) $block    = 0;
if( empty($foul)  ) $foul   = 0;
if( empty($ftm) ) $ftm  = 0;
if( empty($FTA) ) $FTA  = 0;
// if (empty ($gameid)) $gameid =null;
$time = explode(':', $time); // convert string to array of minutes and seconds
if( count($time) >= 2 )
{
  $minutes = (int)$time[0];
  $seconds = (int)$time[1];
}
else if( count($time) == 1 )
{
  $minutes = (int)$time[0];
  $seconds = 0;
}
else
{
  $minutes = 0;
  $seconds = 0;
}


if( ! empty($name) )  // Verify required fields are present
{
  session_start();

  require_once( 'config.php' );
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }
    $query = "UPDATE STATS AS S
                SET
              S.PLAYINGTIMEMIN =?,
              S.PLAYINGTIMESEC=?,
              S.POINTS=?,
              S.ASSISTS=?,
              S.REBOUNDS=?,
              S.THREE_POINTS=?,
              S.FTA=?,
              S.STEAL=?,
              S.BLOCK=?,
              S.FTM=?,
              S.FOUL=?
              WHERE S.SGAME_ID ='$gameid'  AND S.SPLAYER_ID = '$name'
                ";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddddddddddd',
      $minutes,
      $seconds,
      $points,
      $assists,
      $rebounds ,
      $three_points,
      $FTA,
      $STEAL,
      $block,
      $ftm,
      $foul
      );

    $stmt->execute();
  }
  $db->close();


header('location: admin_page.php');
exit;
?>
