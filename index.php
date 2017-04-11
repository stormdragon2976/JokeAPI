<?php
ob_start();
// Get variables
if (!isset($_GET['api']))
{
$api = $_GET['api'];
}
if (!isset($_GET['type']))
{
$type = $_GET['type'];
}
else
{
$type = "default";
}
// this makes for an ever expanding joke catalog:
switch ("$type")
{
default:
require_once("scripts/jokes.php");
}
// Return a random joke from the list:
echo $jokeList[array_rand($jokeList)];

ob_end_flush();
?>
