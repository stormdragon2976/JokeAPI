<?php
$knock = array(
"orange" => "Orange you glad I didn't say banana?",
"scold" => "Scold enough out here to go ice skating!",
"smellma" => "Smellma poo!",
"owls go" => "Thats right! Owls go who!",
"claire" => "Claire the way, I'm coming in!",
"cows go" => "No silly, cows go moo!",
"boo" => "It's ok, don't cry!",
"willis" => "Willis dick fit in your mouth?",
"radio" => "Radio not, here I come!",
"savior" => "Savior breath and open the door!",
"henrietta" => "Henrietta worm that was in his apple!",
"cd's" => "I want to Cd's nuts on your chin!",
"I am" => "You mean you don't know who you are?",
"dewie" => "Dewie have to use a condom?",
"honey bee" => "Honey bee a dear and grab me a beer!",
"bender" => "Bender over and tap it good!",
"madam" => "Madam finger's stuck in the door!",
"cargo" => "No silly, cars go beep beep!",
"howie" => "Howie gonna hide this body?",
"shelby" => "Shelby coming 'round the mountain when she comes!",
"mikey" => "Mikey isn't working, can you let me in?",
"little old lady" => "Awesome yodeling!",
"hatch" => "Bless you!"
);
$jokeName = array_rand($knock);
$joke = "Knock knock:\nWhose there?\n" . ucfirst($jokeName) . ":\n" . ucfirst($jokeName) . " who?\n" . $knock[$jokeName];
?>
