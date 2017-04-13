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
//Make an array to hold file list so we can generate links for joke categories.
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
if ($api == "false")
{ ?>
<!DOCTYPE html>
   <html>
<head>
<meta charset="UTF-8">
<title><?php echo "$title"; ?></title>
</head>
<body> 
<h1>Categories</h1>
<ul><?php
foreach ($jokeFiles as $i)
{ ?>
<li><a href="index.php/?type=<?php echo substr($i, 0, -4); ?>"><?php echo substr($i, 0, -4); ?></a>
<?php }
?></ul>
<h1>Joke</h1>
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
// Run random joke file from the scripts directory 
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
case "json":
echo json_encode($joke);
break;
case "txt":
case "text":
echo $joke;
break;
case "xml":
echo xmlrpc_encode($joke);
break;
default:
echo nl2br($joke);
?>
</p>
<hr />
<ul>
<li><a href="https://github.com/stormdragon2976/JokeAPI">Get your own instance of the Joke API</a></li>
</ul>
</body>
</html>
<?php }
ob_end_flush();
?>
