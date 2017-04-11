<?php
ob_start();
// Load settings:
require_once ("settings.php");
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
if (($type == "all") || ($type == "random"))
{
//Make an array to hold directory list.
$jokeFiles = array();
//Create a handler for the directory.
$handler = opendir("scripts");
while ($file = readdir($handler))
{
//If file isn't this directory or its parent, add it to the results.
if (($file != ".") && ($file != "..") && (substr($file, -4) == ".php"))
{
$jokeFiles[] = $file;
}
}
//Close the handler.
closedir($handler);
// Now, Run random joke file from the scripts directory 
require_once ("scripts/" . $jokeFiles[array_rand($jokeFiles)]);
}
else
{
$joke = "I was unable to find any jokes  of type $type.";
}
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
