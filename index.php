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
<ul>
<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?type=random">random</a><?php
foreach ($jokeFiles as $i)
{ ?>
<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?type=<?php echo substr($i, 0, -4); ?>"><?php echo str_replace("_", " ", substr($i, 0, -4)); ?></a>
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
// Set the header for json:
header('Content-type: application/json');
// Create array for joke output:
$joke = array("joke" => $joke);
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
<h2>API Usage</h2>
<p>
To call the api, simply specify the api in the url. For example:<br />
curl -s &apos;<?php $apiTypes = array("json", "text", "txt", "xml");if ((isset($_SERVER['SERVER_PORT'])) && ($_SERVER['SERVER_PORT'] == 443)) { echo "https://"; } else { echo "http://"; } echo $_SERVER['HTTP_HOST'] ?>?api=<?php echo $apiTypes[array_rand($apiTypes)]; ?>&apos;<br />
Jokes can be returned in text, which may be abbreviated  as txt, json, or xml.
</p>
<p>
You may also specify the type of joke to be returned. The keywords all or random will pick from all available joke files. Currently, this server has the following  joke files available:<br />
</p>
<ul><?php
foreach ($jokeFiles as $i)
{
echo "<li>" . substr($i, 0, -4) . "</li>";
} ?>
</ul>
<p>
Here is an example where both the output and joke type are specified:<br />
curl -s &apos;<?php if ((isset($_SERVER['SERVER_PORT'])) && ($_SERVER['SERVER_PORT'] == 443)) { echo "https://"; } else { echo "http://"; } echo $_SERVER['HTTP_HOST'] ?>?api=<?php echo $apiTypes[array_rand($apiTypes)] . "&amp;type=" . substr($jokeFiles[array_rand($jokeFiles)], 0, -4); ?>&apos;
</p>
<hr />
<ul>
<?php
if (isset($gs))
{ ?>
<li><a href="<?php echo $gs; ?>">Follow me on GNU Social</a></li>
<?php } ?>
<li><a href="https://github.com/stormdragon2976/JokeAPI">Get your own instance of the Joke API</a></li>
</ul>
</body>
</html>
<?php }
ob_end_flush();
?>
