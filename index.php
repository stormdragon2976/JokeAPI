<?php
ob_start();
// Load settings:
require_once ("scripts/settings.php");
// Get variables
if (isset($_GET['api']))
{
$api = addslashes($_GET['api']);
}
else
{
$api = "false";
}
if (isset($_GET['type']))
{
$type = addslashes($_GET['type']);
}
else
{
$type = "joke";
}
if ($api == "false")
{ ?>
<!DOCTYPE html>
   <html>
<head>
<meta charset="UTF-8">
<title><?php echo "$title"; ?></title>
</head>
<body> 
<p>
<?php }
// this makes for an ever expanding joke catalog:
if (file_exists("scripts/$type.php"))
{
require_once("scripts/$type.php");
}
else
{
$joke = "I was unable to find any jokes  of type $type.";
}
// Return a random joke from the list:
switch ("$api")
{
default:
echo nl2br($joke);
?>
</p>
</body>
</html>
<?php }
ob_end_flush();
?>
