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
$type = "default";
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
switch ("$type")
{
default:
require_once("scripts/jokes.php");
}
// Return a random joke from the list:
echo "$joke";
if ($api == "false")
{ ?>
</p>
</body>
</html>
<?php }
ob_end_flush();
?>
