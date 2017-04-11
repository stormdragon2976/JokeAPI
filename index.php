<?php
require_once("scripts/jokes.php");
// Return a random joke from the list:
echo $jokeList[array_rand($jokeList)];
?>
